@extends('plantilla')

@section('content')

<div class="main-content">

    <div class="container py-5">

        <h2 class="text-center mb-5">🎭 Próximos Eventos</h2>

        @if(isset($eventos) && $eventos->count() > 0)

            <div class="row g-4">

                @foreach($eventos as $evento)

                    <div class="col-md-4">

                        <div class="card h-100 shadow-sm border-0">

                            <img src="{{ asset('img/proxEventos/' . $evento->imagen) }}"
                                 class="card-img-top"
                                 alt="{{ $evento->nombre }}">

                            <div class="card-body text-center">

                                <h5 class="fw-bold">{{ $evento->nombre }}</h5>

                                <p class="text-muted">
                                    {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                                </p>

                                <p class="fw-semibold">
                                    ${{ number_format($evento->precio, 0, ',', '.') }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center text-muted">
                <h4>No hay eventos próximos</h4>
            </div>

        @endif

    </div>

</div>

@endsection