@extends('layouts.app')

@section('title', 'Inicio - ' . ($setting->site_name ?? 'DigiGrow'))

@section('content')

    <!-- Banner Principal (Home) -->
    <section class="hero-banner text-white d-flex align-items-center position-relative py-5" 
             style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ !empty($setting?->home_banner) ? asset('storage/' . $setting->home_banner) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80' }}') center/cover;">
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

    <!-- Sección de Categorías Destacadas -->
    @if(isset($categories) && $categories->count() > 0)
        <section class="py-5 bg-white">
            <div class="container">
                <h3 class="fw-bold text-center mb-4">Categorías Principales</h3>
                <div class="row g-3 justify-content-center">
                    @foreach($categories as $category)
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="card h-100 text-center border-0 shadow-sm p-3">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid mb-2 rounded" style="height: 60px; object-fit: contain;">
                                @else
                                    <i class="fas fa-folder fa-2x text-primary mb-2"></i>
                                @endif
                                <h6 class="fw-bold text-dark small mb-0">{{ $category->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Sección de Productos Destacados -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Productos Destacados</h3>
            </div>
            
            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100 product-card border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="bg-white p-3 text-center border-bottom" style="height: 200px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid h-100" alt="{{ $product->name }}" style="object-fit: contain;">
                                @else
                                    <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-box-open fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <small class="text-uppercase text-muted fw-bold small mb-1">{{ $product->category->name ?? 'General' }}</small>
                                <h6 class="fw-bold card-title mb-2 text-dark">{{ $product->name }}</h6>
                                @if($product->sku)
                                    <small class="text-muted mb-3">SKU: {{ $product->sku }}</small>
                                @endif
                                
                                @if(!empty($setting?->whatsapp))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20cotizar%20el%20producto:%20{{ urlencode($product->name) }}" 
                                       target="_blank" class="btn btn-outline-success w-100 rounded-pill btn-sm fw-bold mt-auto">
                                        <i class="fab fa-whatsapp me-1"></i> Cotizar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <p>No hay productos destacados disponibles en este momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sección de Servicios -->
    @if(isset($services) && $services->count() > 0)
        <section class="py-5 bg-white border-top">
            <div class="container">
                <h3 class="fw-bold text-center mb-4">Nuestros Servicios</h3>
                <div class="row g-4">
                    @foreach($services as $service)
                        <div class="col-12 col-md-4">
                            <div class="card h-100 border-0 shadow-sm p-3">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top rounded mb-3" style="height: 160px; object-fit: cover;" alt="{{ $service->name }}">
                                @endif
                                <h5 class="fw-bold">{{ $service->name }}</h5>
                                <p class="text-muted small mb-0">{{ Str::limit($service->description, 120) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection