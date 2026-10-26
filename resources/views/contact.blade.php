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

    <!-- 1. CARRUSEL DE NUESTRAS TIENDAS / SEDES -->
    @include('partials.stores-carousel')

    <hr class="my-5 opacity-25">

    <section class="py-5">
    <div class="container">
        @include('partials.contact-form')
    </div>

@endsection