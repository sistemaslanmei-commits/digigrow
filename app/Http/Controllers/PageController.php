<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
// Página de Inicio (Home)
    public function home()
    {
        $setting = Setting::first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->take(8)->get();
        $categories = Category::where('is_active', true)->take(6)->get();

        return view('home', compact('setting', 'services', 'featuredProducts', 'categories'));
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

        return view('contact', compact('setting'));
    }
}
