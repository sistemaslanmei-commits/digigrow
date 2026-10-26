@extends('layouts.app')

@section('title', 'Inicio - ' . ($setting->site_name ?? 'DigiGrow'))

@section('content')
    <section class="hero-banner text-white d-flex align-items-center position-relative py-5" 
             style="background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ !empty($setting?->home_banner) ? asset('storage/' . $setting->home_banner) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80' }}') center/cover no-repeat; min-height: 450px;">
        <div class="container text-center py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3 text-white">{{ $setting->site_name ?? 'DigiGrow' }}</h1>
                    <p class="lead mb-4 text-white-50">Equipamiento de cómputo, servidores, redes y soporte técnico especializado para potenciar tu empresa.</p>
                    @if(!empty($setting?->whatsapp))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20mayor%20información%20sobre%20sus%20productos" 
                           target="_blank" class="btn btn-primary btn-lg rounded-pill px-4 shadow fw-bold">
                            <i class="fab fa-whatsapp me-2"></i> Cotizar por WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        
        <!-- Categorías Principales (Padres) -->
        @if(isset($categories) && $categories->whereNull('parent_id')->count() > 0)
            <div class="mb-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark mb-1">Categorías Principales</h3>
                    <p class="text-muted small">Explora nuestras áreas de equipamiento e infraestructura tecnológica</p>
                </div>
                
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
                    @foreach($categories->whereNull('parent_id') as $parentCategory)
                        <div class="col">
                            <a href="{{ route('catalogo', ['categoria' => $parentCategory->slug]) }}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm text-center p-3 product-card bg-white rounded-3">
                                    @if($parentCategory->image)
                                        <img src="{{ asset('storage/' . $parentCategory->image) }}" class="img-fluid mx-auto mb-2" alt="{{ $parentCategory->name }}" style="height: 65px; object-fit: contain;">
                                    @else
                                        <div class="py-2 text-primary">
                                            <i class="fas fa-layer-group fa-2x"></i>
                                        </div>
                                    @endif
                                    <h6 class="fw-bold text-dark small mb-1">{{ $parentCategory->name }}</h6>
                                    @if($parentCategory->children->count() > 0)
                                        <span class="badge bg-light text-muted border border-secondary-subtle font-monospace" style="font-size: 0.68rem;">
                                            {{ $parentCategory->children->count() }} subcategorías
                                        </span>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Productos Destacados -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0"><i class="fas fa-star text-warning me-2"></i> Productos Destacados</h3>
            <a href="{{ route('catalogo') }}" class="btn btn-outline-primary btn-sm rounded-pill fw-semibold">Ver Todo el Catálogo</a>
        </div>
        <!-- Productos Destacados -->

        <!-- Productos Destacados -->
        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($featuredProducts as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 product-card rounded-3 overflow-hidden position-relative">
                            
                            <!-- Imagen Clicable que redirige a los detalles del producto -->
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-light p-3 text-center d-block" style="height: 190px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top h-100" alt="{{ $product->name }}" style="object-fit: contain;">
                                @else
                                    <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-box-open fa-3x"></i>
                                    </div>
                                @endif
                            </a>

                            <div class="card-body d-flex flex-column p-3">
                                <span class="badge bg-primary-subtle text-primary align-self-start mb-2 px-2 py-1 rounded-pill small">
                                    {{ $product->category->name ?? 'General' }}
                                </span>
                                
                                <!-- Título Clicable que redirige a los detalles -->
                                <h5 class="card-title fw-bold fs-6 mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none">
                                        {{ $product->name }}
                                    </a>
                                </h5>

                                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->short_description, 65) }}</p>
                                
                                @if($product->sku)
                                    <small class="text-muted d-block mb-3"><i class="fas fa-barcode me-1"></i> SKU: {{ $product->sku }}</small>
                                @endif

                                <!-- Botones de Acción (Ver Detalle y Cotizar por WhatsApp) -->
                                <div class="mt-auto d-grid gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm rounded-pill fw-bold">
                                        <i class="fas fa-eye me-1"></i> Ver Detalle
                                    </a>
                                    
                                    @if(!empty($setting?->whatsapp))
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20estoy%20interesado%20en%20el%20producto:%20{{ urlencode($product->name) }}" 
                                           target="_blank" class="btn btn-outline-success btn-sm rounded-pill fw-bold">
                                            <i class="fab fa-whatsapp me-1"></i> Cotizar
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center py-4" role="alert">
                <i class="fas fa-info-circle fa-2x mb-2"></i>
                <p class="mb-0">No hay productos destacados registrados actualmente.</p>
            </div>
        @endif
    </div>


    <!-- 1. SECCIÓN CARRUSEL DE TIENDAS / SEDES EN HOME -->
    @include('partials.stores-carousel')

    <div class="container my-5">

        <hr class="my-5 opacity-25">

        <!-- Sección Nosotros -->
        @include('partials.about-partial')

        <hr class="my-5 opacity-25">

        <!-- Sección Contacto Directo -->
        <section class="py-4">
            <div class="text-center mb-5">
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold mb-2">Contacto Directo</span>
                <h2 class="fw-bold text-dark">¿Tienes un Proyecto o Necesitas Cotizar?</h2>
                <p class="text-muted">Ponte en contacto con nuestro equipo comercial y técnico para una atención inmediata.</p>
            </div>

            @include('partials.contact-form')
        </section>

    </div>

@endsection