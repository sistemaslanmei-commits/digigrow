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

  @include('partials.about-partial')

@endsection