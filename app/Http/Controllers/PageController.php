<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class PageController extends Controller
{
// Página de Inicio (Home)
    public function home()
    {
        $setting = Setting::first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->take(8)->get();
        $categories = Category::where('is_active', true)->whereNull('parent_id')->get();
        
        // 1. OBTENER TIENDAS ACTIVAS PARA EL HOME
        $stores = Store::where('is_active', true)->orderBy('sort_order')->get();

        // 2. ENVIAR 'stores' A LA VISTA HOME
        return view('home', compact('setting', 'services', 'featuredProducts', 'categories', 'stores'));
    }

    // Página Nosotros (About)
    public function about()
    {
        $setting = Setting::first();
        $brands = Brand::where('is_active', true)->get();

        return view('about', compact('setting', 'brands'));
    }

    // Página Contacto (Contact)
    public function contact()
    {
        $setting = Setting::first();
        $stores = Store::where('is_active', true)->orderBy('sort_order')->get();
        return view('contact', compact('setting', 'stores'));
    }

    // Página General del Catálogo
    public function catalogo(Request $request)
    {
        $setting = Setting::first();
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        $query = Product::where('is_active', true);

        // 1. FILTRO POR CATEGORÍA (Padre e Hijas)
        if ($request->has('categoria') && !empty($request->categoria)) {
            $selectedCategory = Category::where('slug', $request->categoria)->first();

            if ($selectedCategory) {
                // Obtenemos el ID de la categoría seleccionada + los IDs de sus subcategorías hijas
                $categoryIds = array_merge(
                    [$selectedCategory->id],
                    $selectedCategory->children()->pluck('id')->toArray()
                );

                // Filtramos los productos que pertenezcan a cualquiera de esos IDs
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Filtro por Marca
        if ($request->filled('marca')) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('slug', $request->marca);
            });
        }

        // Buscador general
        if ($request->filled('buscar')) {
            $term = $request->buscar;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', "%{$term}%")
                  ->orWhere('sku', 'LIKE', "%{$term}%")
                  ->orWhere('short_description', 'LIKE', "%{$term}%");
            });
        }

        $products = $query->orderBy('sort_order')->paginate(12)->withQueryString();

        return view('catalogo', compact('setting', 'categories', 'brands', 'products'));
    }

    // Ficha Individual de Producto
    public function productDetail($slug)
    {
        $setting = Setting::first();
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Productos relacionados de la misma categoría
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('product-detail', compact('setting', 'product', 'relatedProducts'));
    }

    // Vista de Servicios
    public function servicios()
    {
        $setting = Setting::first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('services', compact('setting', 'services'));
    }

    // Procesar Formulario de Contacto
    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', '¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente.');
    }




}
