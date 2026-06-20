@extends('plantilla')

@section('content')

<div class="main-content">

    <!-- =========================
        CARRUSEL PRINCIPAL
    ========================== -->
    <div id="carouselExampleCaptions"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="3000">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('img/carrusel/carrusel1.jpg') }}"
                     class="d-block w-100 carousel-img"
                     alt="">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('img/carrusel/carrusel2.jpg') }}"
                     class="d-block w-100 carousel-img"
                     alt="">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('img/carrusel/carrusel3.jpg') }}"
                     class="d-block w-100 carousel-img"
                     alt="">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('img/carrusel/carrusel4.jpg') }}"
                     class="d-block w-100 carousel-img"
                     alt="">
            </div>

        </div>

        <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>

    <!-- =========================
        PRÓXIMOS EVENTOS
    ========================== -->
    <section class="eventos-section py-5">

        <div class="container">

            <h2 class="text-center titulo-eventos mb-5">
                🎭 Próximos Eventos
            </h2>

            @if($eventos->count() > 0)

                <div id="eventosCarousel"
                     class="carousel slide"
                     data-bs-ride="carousel"
                     data-bs-interval="8000"
                     data-bs-pause="hover">

                    <div class="carousel-inner">

                        @foreach($eventos->chunk(3) as $chunk)

                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                                <div class="row justify-content-center g-4">

                                    @foreach($chunk as $evento)

                                        <div class="col-md-4">

                                            <div class="card evento-card h-100 shadow-sm border-0">

                                                <img src="{{ asset('img/proxEventos/' . $evento->imagen) }}"
                                                     class="evento-img"
                                                     alt="{{ $evento->nombre }}">

                                                <div class="card-body text-center d-flex flex-column">

                                                    <h5 class="fw-bold">
                                                        {{ $evento->nombre }}
                                                    </h5>

                                                    <p class="text-muted mb-1">
                                                        {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                                                    </p>

                                                    <p class="evento-precio fw-semibold">
                                                        ${{ number_format($evento->precio, 0, ',', '.') }}
                                                    </p>

                                                    <p class="text-muted small">
                                                        🎟️ Quedan {{ $evento->stock_disponible }} entradas
                                                    </p>

                                                    {{-- BOTÓN DE COMPRA SEGÚN ROL --}}
                                                    @auth
                                                        @if(auth()->user()->rol_id == 2)
                                                            {{-- CLIENTE: puede comprar --}}
                                                            <form action="{{ route('carrito.agregar.evento', $evento->id) }}"
                                                                  method="POST"
                                                                  class="mt-auto">
                                                                @csrf
                                                                <button type="submit"
                                                                        class="btn btn-purple w-100">
                                                                    🎟️ Comprar entrada
                                                                </button>
                                                            </form>
                                                        @else
                                                            {{-- ADMIN: mensaje informativo --}}
                                                            <div class="mt-auto">
                                                                <p class="text-muted small mb-0">
                                                                    👤 Acceso solo para clientes
                                                                </p>
                                                                <a href="{{ route('admin.eventos.index') }}"
                                                                   class="btn btn-outline-secondary w-100 mt-1">
                                                                    📋 Gestionar eventos
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @else
                                                        {{-- INVITADO: botón para iniciar sesión --}}
                                                        <a href="{{ route('login') }}"
                                                           class="btn btn-outline-secondary w-100 mt-auto">
                                                            🔑 Iniciar sesión para comprar
                                                        </a>
                                                    @endauth

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>

                    <button class="carousel-control-prev"
                            type="button"
                            data-bs-target="#eventosCarousel"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next"
                            type="button"
                            data-bs-target="#eventosCarousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>

                {{-- BOTÓN VER MÁS --}}
                <div class="text-center mt-4">

                    @auth

                        @if(auth()->user()->rol_id == 1)
                            {{-- ADMIN --}}
                            <a href="{{ route('admin.eventos.index') }}"
                               class="btn btn-primary px-4">
                                📋 Gestionar eventos
                            </a>

                        @else
                            {{-- CLIENTE --}}
                            <a href="{{ route('eventos.proximos') }}"
                               class="btn btn-primary px-4">
                                🎭 Ver más eventos
                            </a>
                        @endif

                    @else

                        {{-- NO LOGUEADO --}}
                        <a href="{{ route('login') }}" class="btn btn-primary px-4">
                            🔑 Ver más eventos
                        </a>

                    @endauth

                </div>

                        {{-- BOTÓN VER TODOS LOS EVENTOS (AGREGADO) --}}
                        <div class="text-center mt-3">
                           <a href="{{ route('eventos.todos') }}" class="btn btn-outline-primary px-4">
                                  🎭 Ver todos los eventos
                           </a>
                        </div>

            @else

                <div class="text-center text-muted py-5">

                    <h4>🔍 No hay eventos disponibles</h4>

                    <a href="{{ url('/') }}" class="btn btn-purple mt-3">
                        Recargar
                    </a>

                </div>

            @endif

        </div>

    </section>

</div>

@endsection