@extends('layouts.app')

@section('title', 'Nosotros - ' . ($setting->site_name ?? 'DigiGrow'))

@section('content')

    <!-- Banner Nosotros -->
    <section class="hero-banner text-white d-flex align-items-center py-5" 
             style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ !empty($setting?->about_banner) ? asset('storage/' . $setting->about_banner) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80' }}') center/cover;">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold">Sobre Nosotros</h1>
            <p class="lead mb-0">Conoce más sobre {{ $setting->site_name ?? 'DigiGrow' }} y nuestra trayectoria</p>
        </div>
    </section>

    <!-- Información Institucional -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-12 col-lg-6">
                    <h3 class="fw-bold mb-3 text-primary">Soluciones Tecnológicas a Tu Alcance</h3>
                    <p class="text-muted">En <strong>{{ $setting->site_name ?? 'DigiGrow' }}</strong> nos dedicamos a ofrecer equipamiento de última generación y consultoría técnica personalizada para potenciar a empresas e instituciones.</p>
                    <p class="text-muted">Contamos con un equipo altamente calificado para acompañarte desde la selección de equipos hasta el soporte integral del servicio.</p>
                </div>
                <div class="col-12 col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80" alt="Nosotros" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Marcas / Partners -->
    @if(isset($brands) && $brands->count() > 0)
        <section class="py-5">
            <div class="container text-center">
                <h4 class="fw-bold mb-4">Marcas con las que Trabajamos</h4>
                <div class="row g-4 align-items-center justify-content-center">
                    @foreach($brands as $brand)
                        <div class="col-6 col-sm-4 col-md-2">
                            <div class="bg-white p-3 rounded shadow-sm h-100 d-flex align-items-center justify-content-center">
                                @if($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height: 50px;">
                                @else
                                    <span class="fw-bold text-muted">{{ $brand->name }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection