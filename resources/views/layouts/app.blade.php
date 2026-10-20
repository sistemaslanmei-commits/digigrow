<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $setting->site_name ?? 'DigiGrow - Catálogo Digital')</title>
    
    <!-- Bootstrap 5.3 CSS & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .hero-banner {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 529px;
        }
        .product-card:hover {
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Navegación Principal / Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if(!empty($setting?->logo))
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" style="max-height: 40px;" class="me-2 rounded">
                @else
                    <i class="fas fa-layer-group text-primary me-2 fa-lg"></i>
                @endif
                <span class="fw-bold fs-4">{{ $setting->site_name ?? 'DigiGrow' }}</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active text-primary' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-building me-1"></i> Nosotros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active text-primary' : '' }}" href="{{ route('contact') }}">
                            <i class="fas fa-envelope me-1"></i> Contacto
                        </a>
                    </li>
                </ul>
                
                @if(!empty($setting?->whatsapp))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="btn btn-success btn-sm rounded-pill ms-lg-3 px-3 fw-bold">
                        <i class="fab fa-whatsapp me-1"></i> Cotizar WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Contenido Principal de las Vistas -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Pie de Página Dinámico / Footer -->
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <h5 class="fw-bold text-primary mb-3">{{ $setting->site_name ?? 'DigiGrow' }}</h5>
                    <p class="small mb-3">Soluciones tecnológicas integrales y catálogo digital de alta tecnología.</p>
                    <div class="d-flex gap-3">
                        @if(!empty($setting?->facebook_url))
                            <a href="{{ $setting->facebook_url }}" target="_blank" class="text-white fs-5"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(!empty($setting?->instagram_url))
                            <a href="{{ $setting->instagram_url }}" target="_blank" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($setting?->linkedin_url))
                            <a href="{{ $setting->linkedin_url }}" target="_blank" class="text-white fs-5"><i class="fab fa-linkedin"></i></a>
                        @endif
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3">Contacto Directo</h6>
                    <ul class="list-unstyled small">
                        @if(!empty($setting?->phone))
                            <li class="mb-2"><i class="fas fa-phone text-primary me-2"></i>{{ $setting->phone }}</li>
                        @endif
                        @if(!empty($setting?->email))
                            <li class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>{{ $setting->email }}</li>
                        @endif
                        @if(!empty($setting?->address))
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $setting->address }}</li>
                        @endif
                    </ul>
                </div>

                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3">Navegación</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('home') }}" class="text-decoration-none ">Inicio</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none ">Nosotros</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none">Contacto</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-secondary my-4">
            <div class="text-center small">
                &copy; {{ date('Y') }} {{ $setting->site_name ?? 'DigiGrow' }}. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>