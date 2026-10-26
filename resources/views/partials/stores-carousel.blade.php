<section id="lanmei-tiendas" class="py-5">
    <style>
        #lanmei-tiendas {
            --lanmei-blue: #173B67;
            --lanmei-bg: #F8FBFE;
            width: 100%;
            background: var(--lanmei-bg);
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            box-sizing: border-box;
        }

        #lanmei-tiendas *,
        #lanmei-tiendas *::before,
        #lanmei-tiendas *::after {
            box-sizing: border-box;
        }

        #lanmei-tiendas .tiendas-container {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 0 clamp(12px, 2vw, 32px);
        }

        /* Encabezado */
        #lanmei-tiendas .tiendas-header {
            text-align: center;
            margin-bottom: 28px;
        }

        #lanmei-tiendas .tiendas-subtitulo {
            display: inline-block;
            padding: 8px 16px;
            margin-bottom: 15px;
            border-radius: 50px;
            background: #EAF3FC;
            color: var(--lanmei-blue);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        #lanmei-tiendas .tiendas-titulo {
            margin: 0 0 14px;
            color: #172B45;
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            line-height: 1.2;
        }

        #lanmei-tiendas .tiendas-descripcion {
            max-width: 600px;
            margin: 0 auto;
            color: #64748B;
            font-size: 16px;
            line-height: 1.7;
        }

        /* Carrusel */
        #lanmei-tiendas .tiendas-slider {
            width: 100%;
            margin: 0;
        }

        #lanmei-tiendas .tienda-slide {
            padding: 10px;
        }

        /* Tarjetas cuadradas */
        #lanmei-tiendas .tienda-card {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            background: var(--lanmei-blue);
            box-shadow: 0 12px 32px rgba(23, 59, 103, .14);
            isolation: isolate;
        }

        #lanmei-tiendas .tienda-imagen {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s ease;
        }

        #lanmei-tiendas .tienda-card::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(
                to top,
                rgba(7, 20, 39, .96) 0%,
                rgba(7, 20, 39, .78) 28%,
                rgba(7, 20, 39, .35) 53%,
                rgba(7, 20, 39, .04) 100%
            );
            pointer-events: none;
        }

        #lanmei-tiendas .tienda-contenido {
            position: absolute;
            z-index: 2;
            left: 0;
            right: 0;
            bottom: 0;
            padding: clamp(18px, 3vw, 36px);
            color: #fff;
        }

        #lanmei-tiendas .tienda-etiqueta {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            margin-bottom: 12px;
            border-radius: 50px;
            background: rgba(255, 255, 255, .17);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            backdrop-filter: blur(8px);
        }

        #lanmei-tiendas .tienda-punto {
            width: 7px;
            height: 7px;
            flex: 0 0 7px;
            border-radius: 50%;
            background: #76E5A2;
        }

        #lanmei-tiendas .tienda-nombre {
            margin: 0 0 10px;
            color: #fff;
            font-size: clamp(24px, 2.6vw, 34px);
            font-weight: 800;
            line-height: 1.2;
        }

        #lanmei-tiendas .tienda-direccion {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 0 0 18px;
            color: rgba(255, 255, 255, .94);
            font-size: 14px;
            line-height: 1.6;
        }

        #lanmei-tiendas .tienda-direccion i {
            margin-top: 2px;
            color: #fff;
            font-size: 18px;
            flex-shrink: 0;
        }

        #lanmei-tiendas .tienda-boton {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-width: 170px;
            padding: 12px 16px;
            border: 1px solid #fff;
            border-radius: 10px;
            background: #fff;
            color: var(--lanmei-blue);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background .25s ease, color .25s ease;
        }

        #lanmei-tiendas .tienda-boton:hover {
            background: transparent;
            color: #fff;
        }

        /* Controles */
        #lanmei-tiendas .tiendas-controles {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            margin-top: 22px;
        }

        #lanmei-tiendas .tiendas-flecha {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border: 1px solid #D9E4F0;
            border-radius: 50%;
            background: #fff;
            color: var(--lanmei-blue);
            font-size: 20px;
            cursor: pointer;
            transition: all .25s ease;
        }

        #lanmei-tiendas .tiendas-flecha:hover {
            background: var(--lanmei-blue);
            color: #fff;
        }

        #lanmei-tiendas .tiendas-contador {
            min-width: 55px;
            color: #64748B;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
        }

        #lanmei-tiendas .slick-dots {
            position: static;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            margin: 18px 0 0;
            padding: 0;
            list-style: none;
        }

        #lanmei-tiendas .slick-dots li button {
            width: 8px;
            height: 8px;
            padding: 0;
            border: none;
            border-radius: 20px;
            background: #CAD6E4;
            transition: all .25s ease;
        }

        #lanmei-tiendas .slick-dots li button:before {
            display: none;
        }

        #lanmei-tiendas .slick-dots li.slick-active button {
            width: 25px;
            background: var(--lanmei-blue);
        }

        @media (hover: hover) and (min-width: 768px) {
            #lanmei-tiendas .tienda-card:hover .tienda-imagen {
                transform: scale(1.035);
            }
        }

        @media (max-width: 575.98px) {
            #lanmei-tiendas .tienda-card {
                aspect-ratio: 1 / 1;
                border-radius: 16px;
            }
            #lanmei-tiendas .tienda-contenido {
                padding: 14px;
            }
            #lanmei-tiendas .tienda-boton {
                width: 100%;
                min-width: 0;
            }
        }
    </style>

@if(isset($stores) && $stores->count() > 0)
    <div class="tiendas-container">

        <!-- Encabezado -->
        <header class="tiendas-header">
            <span class="tiendas-subtitulo">Estamos cerca de ti</span>
            <h2 class="tiendas-titulo">Conoce nuestras tiendas</h2>
            <p class="tiendas-descripcion">
                Visítanos y descubre cómo podemos ayudarte.
                Encuentra tu tienda más cercana o contáctanos online.
            </p>
        </header>

        <!-- Carrusel Dinámico de Tiendas -->
        <div class="tiendas-slider">
            @foreach($stores as $store)
                <div class="tienda-slide">
                    <article class="tienda-card">
                        <img
                            src="{{ !empty($store->image) ? asset('storage/' . $store->image) : asset('images/default-store.png') }}"
                            alt="{{ $store->name }}"
                            class="tienda-imagen"
                            loading="lazy"
                        >

                        <div class="tienda-contenido">
                            <span class="tienda-etiqueta">
                                <span class="tienda-punto"></span>
                                {{ $store->tag ?? 'Nuestra tienda' }}
                            </span>

                            <h3 class="tienda-nombre">{{ $store->name }}</h3>

                            <p class="tienda-direccion">
                                <i class="bi {{ $store->icon ?? 'bi-geo-alt-fill' }}"></i>
                                <span>{{ $store->address }}</span>
                            </p>

                            @if(!empty($store->map_url))
                                <a
                                    href="{{ $store->map_url }}"
                                    class="tienda-boton"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <i class="bi {{ str_contains($store->map_url, 'wa.me') ? 'bi-whatsapp' : 'bi-geo-alt' }}"></i>
                                    {{ $store->button_text ?? 'Cómo llegar' }}
                                    <i class="bi bi-arrow-up-right ms-auto"></i>
                                </a>
                            @endif
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <!-- Controles -->
        <div class="tiendas-controles">
            <button
                type="button"
                class="tiendas-flecha tiendas-anterior"
                aria-label="Ver tiendas anteriores"
            >
                <i class="bi bi-arrow-left"></i>
            </button>

            <span class="tiendas-contador" aria-live="polite">1–2 / {{ $stores->count() }}</span>

            <button
                type="button"
                class="tiendas-flecha tiendas-siguiente"
                aria-label="Ver tiendas siguientes"
            >
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>
    </div>

    <!-- Script de Inicialización de Slick -->
     @push('scripts')
    <script>
        (function ($) {
            'use strict';

            function iniciarCarruselTiendas() {
                var $seccion = $('#lanmei-tiendas');
                var $slider = $seccion.find('.tiendas-slider');
                var $contador = $seccion.find('.tiendas-contador');
                var $anterior = $seccion.find('.tiendas-anterior');
                var $siguiente = $seccion.find('.tiendas-siguiente');

                if (!$slider.length || !$.fn.slick || $slider.hasClass('slick-initialized')) {
                    return;
                }

                function actualizarControles(event, slick, currentSlide) {
                    var indice = typeof currentSlide === 'number' ? currentSlide : slick.currentSlide;
                    var total = slick.slideCount;
                    var visibles = slick.options.slidesToShow;
                    var primero = indice + 1;
                    var ultimo = Math.min(indice + visibles, total);

                    if (slick.options.infinite && indice + visibles > total) {
                        ultimo = total;
                    }

                    $contador.text(primero + '–' + ultimo + ' / ' + total);
                }

                $slider.on('init reInit afterChange', actualizarControles);

                $slider.slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 3500,
                    speed: 500,
                    pauseOnHover: true,
                    swipeToSlide: true,
                    responsive: [
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });

                $anterior.on('click', function () {
                    $slider.slick('slickPrev');
                });

                $siguiente.on('click', function () {
                    $slider.slick('slickNext');
                });
            }

            $(document).ready(iniciarCarruselTiendas);
        })(jQuery);
    </script>
    @endpush
@endif
</section>