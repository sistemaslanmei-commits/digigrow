@extends('layouts.app')

@section('title', 'Servicios - ' . ($setting->site_name ?? 'DigiGrow'))

@section('content')

    <!-- Banner Dedicado de Servicios (Usa services_banner desde Filament) -->
    <section class="hero-banner text-white d-flex align-items-center position-relative py-5" 
             style="background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ !empty($setting?->services_banner) ? asset('storage/' . $setting->services_banner) : 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&q=80' }}') center/cover no-repeat; min-height: 320px;">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold text-white">Nuestros Servicios</h1>
            <p class="lead mb-0 text-white-50">Soluciones de infraestructura, soporte técnico e integración tecnológica</p>
        </div>
    </section>

    <!-- Inclusión Limpia del Parcial de Servicios -->
    <div class="container my-5">
        @include('partials.services-partial')
    </div>

@endsection