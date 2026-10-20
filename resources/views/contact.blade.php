@extends('layouts.app')

@section('title', 'Contacto - ' . ($setting->site_name ?? 'DigiGrow'))

@section('content')

    <!-- Banner Contacto -->
    <section class="hero-banner text-white d-flex align-items-center py-5" 
             style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ !empty($setting?->contact_banner) ? asset('storage/' . $setting->contact_banner) : 'https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&w=1200&q=80' }}') center/cover;">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold">Contáctanos</h1>
            <p class="lead mb-0">Estamos aquí para resolver tus dudas y atender tus requerimientos</p>
        </div>
    </section>

    <!-- Canales de Atención -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @if(!empty($setting?->phone))
                    <div class="col-12 col-md-4">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <i class="fas fa-phone-alt fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Teléfono</h5>
                            <p class="text-muted mb-0">{{ $setting->phone }}</p>
                        </div>
                    </div>
                @endif

                @if(!empty($setting?->email))
                    <div class="col-12 col-md-4">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Correo Electrónico</h5>
                            <p class="text-muted mb-0">{{ $setting->email }}</p>
                        </div>
                    </div>
                @endif

                @if(!empty($setting?->address))
                    <div class="col-12 col-md-4">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Dirección</h5>
                            <p class="text-muted mb-0">{{ $setting->address }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Botón de Atención Inmediata por WhatsApp -->
            @if(!empty($setting?->whatsapp))
                <div class="text-center mt-5">
                    <div class="bg-white p-4 rounded-3 shadow-sm d-inline-block">
                        <h4 class="fw-bold mb-3">¿Necesitas una respuesta rápida?</h4>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Hola,%20deseo%20contactar%20con%20un%20asesor" 
                           target="_blank" class="btn btn-success btn-lg rounded-pill px-4 fw-bold">
                            <i class="fab fa-whatsapp me-2"></i> Chatear con un Asesor
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection