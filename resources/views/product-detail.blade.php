@extends('layouts.app')

{{-- Título de la pestaña y previsualización --}}
@section('title', $product->name . ' - ' . ($setting->site_name ?? 'DigiGrow'))

{{-- Descripción específica para Google y WhatsApp --}}
@section('meta_description', Str::limit(strip_tags($product->short_description ?? $product->description), 155))

{{-- Imagen de la tarjeta Open Graph (WhatsApp) --}}
@if($product->image)
    @section('og_image', asset('storage/' . $product->image))
@endif

@section('content')
<!-- Miga de Pan / Breadcrumb -->
<!-- Migas de Pan (Breadcrumb) Nivel 15 - Colocar en product-detail.blade.php -->
 
<div class="container mt-3 mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 px-3 rounded-3 shadow-sm flex-wrap align-items-center mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalogo') }}" class="text-decoration-none fw-semibold">Catálogo</a>
            </li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('catalogo', ['categoria' => $product->category->slug]) }}" class="text-decoration-none">
                        {{ $product->category->name }}
                    </a>
                </li>
            @endif
            <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 160px;">
                {{ $product->name }}
            </li>
        </ol>
    </nav>
</div>

<div class="container mb-5">
    <!-- FILA SUPERIOR: Galería a la izquierda, Resumen y CTAs a la derecha -->
    <div class="row g-3 g-lg-5 align-items-start">
        <!-- Columna Izquierda: Galería Multimedia (image e images) -->
        <div class="col-lg-6">
            <div class="border rounded-4 p-4 text-center bg-white shadow-sm mb-3 position-relative">
                @if($product->is_featured)
                    <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Destacado</span>
                @endif
                
                @if($product->image)
                    <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}" style="max-height: 380px; object-fit: contain;">
                @else
                    <div class="py-5 text-muted">
                        <i class="fas fa-box-open fa-5x mb-3"></i>
                        <p class="mb-0">Sin imagen de portada</p>
                    </div>
                @endif
            </div>

            <!-- Miniaturas de la Galería Secundaría -->
            @if(!empty($product->images) && is_array($product->images) && count($product->images) > 0)
                <div class="d-flex gap-2 overflow-auto pb-2">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail cursor-pointer rounded-3 border-primary" style="width: 70px; height: 70px; object-fit: cover;" onclick="document.getElementById('mainImage').src=this.src">
                    @endif
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail cursor-pointer rounded-3" style="width: 70px; height: 70px; object-fit: cover;" onclick="document.getElementById('mainImage').src=this.src">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Columna Derecha: Cabecera, Atributos Principales y Botones de Acción -->
        <div class="col-lg-6">
            <div class="d-flex align-items-center gap-2 mb-2">
                @if($product->category)
                    <a href="{{ route('catalogo', ['categoria' => $product->category->slug]) }}" 
                        class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill text-decoration-none">
                        {{ $product->category->name }}
                    </a>
                @endif
                @if($product->brand)
                    <a href="{{ route('catalogo', ['marca' => $product->brand->slug]) }}" 
                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-1 rounded-pill text-decoration-none">
                        {{ $product->brand->name }}
                    </a>
                @endif
            </div>

            <h1 class="fw-bold text-dark mb-2">{{ $product->name }}</h1>

            @if($product->sku)
                <p class="text-muted small mb-3"><i class="fas fa-barcode me-1"></i> SKU: <strong class="text-dark">{{ $product->sku }}</strong></p>
            @endif

            @if($product->short_description)
                <p class="lead text-muted fs-6 mb-4">{{ $product->short_description }}</p>
            @endif

            <hr class="my-4 opacity-25">

            <!-- Botones de Acción / CTAs -->
            <div class="d-flex flex-wrap gap-3 mb-4">
                @if(!empty($setting?->whatsapp))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20cotizar%20el%20producto:%20{{ urlencode($product->name) }}%20(SKU:%20{{ $product->sku ?? 'S/N' }})%20Enlace:%20{{ urlencode(route('products.show', $product->slug)) }}" 
                       target="_blank" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm fw-bold">
                        <i class="fab fa-whatsapp me-2"></i>Cotizar por WhatsApp
                    </a>
                @endif

                @if($product->datasheet)
                    <a href="{{ asset('storage/' . $product->datasheet) }}" target="_blank" class="btn btn-outline-danger btn-lg rounded-pill px-4 fw-semibold">
                        <i class="fas fa-file-pdf me-2"></i>Ficha Técnica PDF
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- FILAS VERTICALES INDEPENDIENTES (UNA DEBAJO DE LA OTRA)           -->
    <!-- ================================================================= -->

    <!-- FILA 1 DEBAJO: Descripción General ($product->description) -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h4 class="fw-bold text-dark mb-3 border-bottom pb-2">
                    <i class="fas fa-align-left text-primary me-2"></i>Descripción General
                </h4>
                @if($product->description)
                    <div class="text-muted leading-relaxed fs-6">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @else
                    <p class="text-muted italic mb-0">No hay una descripción detallada disponible para este producto.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- FILA 2 DEBAJO: Especificaciones Técnicas ($product->technical_specifications) -->
    @if(!empty($product->technical_specifications) && is_array($product->technical_specifications) && count($product->technical_specifications) > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h4 class="fw-bold text-dark mb-3 border-bottom pb-2">
                        <i class="fas fa-list-check text-primary me-2"></i>Especificaciones Técnicas
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0 border">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 35%;">Característica / Propiedad</th>
                                    <th>Detalle / Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->technical_specifications as $key => $value)
                                    <tr>
                                        <td class="fw-bold text-dark">{{ $key }}</td>
                                        <td class="text-muted">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- FILA 3 DEBAJO: Productos Relacionados -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-12 mb-3">
                <h4 class="fw-bold text-dark mb-1">Productos Relacionados</h4>
                <p class="text-muted small mb-0">Otras alternativas dentro de la categoría {{ $product->category->name ?? '' }}</p>
            </div>
            @foreach($relatedProducts as $related)
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-3 product-card">
                        <div class="bg-light p-3 text-center rounded-top-3">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" class="img-fluid" alt="{{ $related->name }}" style="height: 130px; object-fit: contain;">
                            @else
                                <div class="py-4 text-muted"><i class="fas fa-box fa-2x"></i></div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="fw-bold text-dark mb-2">{{ $related->name }}</h6>
                            <a href="{{ route('products.show', $related->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill mt-auto w-100">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection