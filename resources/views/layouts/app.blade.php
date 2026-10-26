<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $setting->site_name ?? 'DigiGrow - Catálogo Digital')</title>
    
    <!-- Bootstrap 5.3 CSS & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--iconos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    
    <style>
        .hero-banner {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 280px;
        }
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        }
    </style>
    @stack('styles')
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
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('catalogo') || request()->routeIs('products.show') ? 'active text-primary fw-bold' : '' }}" href="{{ route('catalogo') }}">
                            <i class="fas fa-boxes-stacked me-1"></i> Catálogo
                        </a>
                    </li>
                    <!-- Enlace de Servicios Agregado al Header -->
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('services') ? 'active text-primary fw-bold' : '' }}" href="{{ route('services') }}">
                            <i class="fas fa-tools me-1"></i> Servicios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('about') ? 'active text-primary fw-bold' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-building me-1"></i> Nosotros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('contact') ? 'active text-primary fw-bold' : '' }}" href="{{ route('contact') }}">
                            <i class="fas fa-envelope me-1"></i> Contacto
                        </a>
                    </li>
                </ul>
                
                @if(!empty($setting?->whatsapp))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="btn btn-success btn-sm rounded-pill ms-lg-3 px-3 fw-bold">
                        <i class="fab fa-whatsapp me-1"></i> Cotizar
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
                    <p class="text-white-50 small mb-3">Soluciones tecnológicas integrales y catálogo digital de equipamiento e infraestructura.</p>
                    <div class="d-flex gap-3">
                        @if(!empty($setting?->facebook_url))
                            <a href="{{ $setting->facebook_url }}" target="_blank" class="text-white-50"><i class="fab fa-facebook fs-5"></i></a>
                        @endif
                        @if(!empty($setting?->instagram_url))
                            <a href="{{ $setting->instagram_url }}" target="_blank" class="text-white-50"><i class="fab fa-instagram fs-5"></i></a>
                        @endif
                        @if(!empty($setting?->linkedin_url))
                            <a href="{{ $setting->linkedin_url }}" target="_blank" class="text-white-50"><i class="fab fa-linkedin fs-5"></i></a>
                        @endif
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3">Contacto Directo</h6>
                    <ul class="list-unstyled text-white-50 small">
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
                    <ul class="list-unstyled text-white-50 small">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-white-50">Inicio</a></li>
                        <li><a href="{{ route('catalogo') }}" class="text-decoration-none text-white-50">Catálogo</a></li>
                        <!-- Enlace de Servicios Agregado al Footer -->
                        <li><a href="{{ route('services') }}" class="text-decoration-none text-white-50">Servicios</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none text-white-50">Nosotros</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none text-white-50">Contacto</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-secondary opacity-25 my-4">
            <div class="text-center text-white-50 small">
                &copy; {{ date('Y') }} {{ $setting->site_name ?? 'DigiGrow' }}. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    
    
    <!-- jQuery (Slick depende de jQuery) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Slick Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>