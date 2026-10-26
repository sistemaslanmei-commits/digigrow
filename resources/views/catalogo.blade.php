@extends('layouts.app')

@section('title', 'Catálogo de Productos - ' . ($setting->site_name ?? 'DigiGrow'))

@section('content')

    <!-- Banner Principal del Catálogo -->
    <section class="hero-banner text-white d-flex align-items-center position-relative py-5" 
            style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ !empty($setting?->catalogo_banner) ? asset('storage/' . $setting->catalogo_banner) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80' }}') center/cover;">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold mb-3">{{ $setting->site_name ?? 'DigiGrow' }}</h1>
            <p class="lead mb-4">Catálogo Digital de Soluciones y Equipamiento Tecnológico</p>
            @if(!empty($setting?->whatsapp))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20mayor%20información%20sobre%20sus%20productos" 
                    target="_blank" class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                    <i class="fab fa-whatsapp me-2"></i> Solicitar Cotización
                </a>
            @endif
        </div>
    </section>

    <!-- Contenido Principal del Catálogo -->
    <div class="container py-5">
        <div class="row g-4">
            
            <!-- BARRA LATERAL: Filtros e Árbol de Categorías Padre/Hijo -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 90px; z-index: 10;">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="fas fa-filter text-primary me-2"></i>Filtros
                    </h5>

                    <!-- Buscador por Término -->
                    <form action="{{ route('catalogo') }}" method="GET" class="mb-4">
                        @if(request('categoria')) <input type="hidden" name="categoria" value="{{ request('categoria') }}"> @endif
                        @if(request('marca')) <input type="hidden" name="marca" value="{{ request('marca') }}"> @endif
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm rounded-start-pill ps-3" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre/SKU...">
                            <button type="submit" class="btn btn-primary btn-sm rounded-end-pill px-3">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <hr class="my-3 opacity-25">

                    <!-- ÁRBOL JERÁRQUICO DE CATEGORÍAS (Padres e Hijos) -->
                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-folder-tree text-secondary me-2"></i>Categorías</h6>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2">
                            <a href="{{ route('catalogo', request()->only(['marca', 'buscar'])) }}" 
                               class="text-decoration-none small {{ !request('categoria') ? 'fw-bold text-primary' : 'text-muted' }}">
                                <i class="fas fa-th-large me-1"></i> Todas las Categorías
                            </a>
                        </li>

                        <!-- Iteración de Categorías Padre (parent_id IS NULL) -->
                        @foreach($categories->whereNull('parent_id') as $parent)
                            <li class="mb-2">
                                <a href="{{ route('catalogo', array_merge(request()->only(['marca', 'buscar']), ['categoria' => $parent->slug])) }}" 
                                   class="text-decoration-none small d-flex justify-content-between align-items-center {{ request('categoria') == $parent->slug ? 'fw-bold text-primary' : 'text-dark' }}">
                                    <span>
                                        <i class="fas fa-folder text-warning me-1"></i> {{ $parent->name }}
                                    </span>
                                </a>

                                <!-- Subcategorías (Hijas de la Categoría Padre actual) -->
                                @if($parent->children && $parent->children->count() > 0)
                                    <ul class="list-unstyled ms-3 mt-1 border-start ps-2">
                                        @foreach($parent->children as $child)
                                            <li class="my-1">
                                                <a href="{{ route('catalogo', array_merge(request()->only(['marca', 'buscar']), ['categoria' => $child->slug])) }}" 
                                                   class="text-decoration-none small {{ request('categoria') == $child->slug ? 'fw-bold text-primary' : 'text-muted' }}">
                                                    <i class="fas fa-angle-right me-1 text-secondary"></i> {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <hr class="my-3 opacity-25">

                    <!-- FILTRO POR MARCAS -->
                    @if(isset($brands) && $brands->count() > 0)
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-copyright text-secondary me-2"></i>Marcas</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href="{{ route('catalogo', request()->only(['categoria', 'buscar'])) }}" 
                                   class="text-decoration-none small {{ !request('marca') ? 'fw-bold text-primary' : 'text-muted' }}">
                                    Todas las Marcas
                                </a>
                            </li>
                            @foreach($brands as $brand)
                                <li class="mb-1">
                                    <a href="{{ route('catalogo', array_merge(request()->only(['categoria', 'buscar']), ['marca' => $brand->slug])) }}" 
                                       class="text-decoration-none small {{ request('marca') == $brand->slug ? 'fw-bold text-primary' : 'text-muted' }}">
                                        {{ $brand->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if(request('categoria') || request('marca') || request('buscar'))
                        <div class="mt-4 pt-2 border-top">
                            <a href="{{ route('catalogo') }}" class="btn btn-outline-danger btn-sm rounded-pill w-100">
                                <i class="fas fa-times me-1"></i> Limpiar Filtros
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- GRILLA PÚBLICA DE PRODUCTOS -->
            <div class="col-lg-9">
                @if(isset($products) && $products->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($products as $product)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm rounded-4 product-card overflow-hidden">
                                    <div class="bg-light p-3 text-center position-relative" style="height: 200px;">
                                        @if($product->is_featured)
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-pill">Destacado</span>
                                        @endif
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid h-100" alt="{{ $product->name }}" style="object-fit: contain;">
                                        @else
                                            <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                                <i class="fas fa-box-open fa-3x"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column p-3">
                                        <div class="d-flex align-items-center gap-1 mb-2">
                                            @if($product->category)
                                                <span class="badge bg-primary-subtle text-primary px-2 py-1 rounded-pill small">{{ $product->category->name }}</span>
                                            @endif
                                            @if($product->brand)
                                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill small">{{ $product->brand->name }}</span>
                                            @endif
                                        </div>

                                        <h6 class="fw-bold text-dark mb-1">{{ $product->name }}</h6>
                                        <p class="text-muted small mb-2 flex-grow-1">{{ Str::limit($product->short_description, 70) }}</p>

                                        @if($product->sku)
                                            <small class="text-muted d-block mb-3"><i class="fas fa-barcode me-1"></i> SKU: {{ $product->sku }}</small>
                                        @endif

                                        <div class="mt-auto d-grid gap-2">
                                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm rounded-pill fw-bold">
                                                <i class="fas fa-eye me-1"></i> Ver Detalle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación Laravel -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                        <i class="fas fa-search-minus text-muted fa-4x mb-3"></i>
                        <h4 class="fw-bold text-dark">No se encontraron productos</h4>
                        <p class="text-muted small">Intenta seleccionar otra categoría, marca o prueba con un término de búsqueda distinto.</p>
                        <a href="{{ route('catalogo') }}" class="btn btn-primary rounded-pill px-4 align-self-center mt-2">Ver Todo el Catálogo</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection