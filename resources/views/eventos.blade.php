@extends('plantilla')

@section('content')

<div class="main-content">

    <section class="eventos-section py-5">

        <div class="container">

            <h2 class="text-center titulo-eventos mb-5">
                🎭 Próximos Eventos
            </h2>

            @if($eventos->count() > 0)

                <div class="row g-4">

                    @foreach($eventos as $evento)

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

                                    @if(auth()->check() && auth()->user()->rol_id == 2)

                                        <form action="{{ route('carrito.agregar.evento', $evento->id) }}"
                                              method="POST"
                                              class="mt-auto">

                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-purple w-100">
                                                Comprar entrada
                                            </button>

                                        </form>

                                    @elseif(!auth()->check())

                                        <a href="{{ route('login') }}"
                                           class="btn btn-purple w-100 mt-auto">
                                            Iniciar sesión para comprar
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="text-center text-muted py-5">

                    <h4>🔍 No hay eventos disponibles</h4>

                    <a href="{{ url('/') }}" class="btn btn-purple mt-3">
                        Volver
                    </a>

                </div>

            @endif

        </div>

    </section>

</div>

@endsection