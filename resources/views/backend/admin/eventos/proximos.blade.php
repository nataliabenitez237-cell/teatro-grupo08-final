@extends('plantilla')

@section('content')

<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">
    ← Volver al panel
</a>

<div class="main-content">

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>🎭 Eventos (Admin)</h2>

            <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary">
                + Nuevo evento
            </a>

        </div>

        @if($eventos->count() > 0)

            <div class="row g-4">

                @foreach($eventos as $evento)

                    <div class="col-md-4">

                        <div class="card h-100 shadow-sm border-0">

                            <img src="{{ asset('img/proxEventos/' . $evento->imagen) }}"
                                 class="card-img-top"
                                 alt="{{ $evento->nombre }}">

                            <div class="card-body d-flex flex-column">

                                <h5 class="fw-bold">{{ $evento->nombre }}</h5>

                                <p class="text-muted mb-1">
                                    {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                                </p>

                                <p class="fw-semibold">
                                    ${{ number_format($evento->precio, 0, ',', '.') }}
                                </p>

                                <p class="text-muted small">
                                    🎟️ Stock: {{ $evento->stock_disponible }}
                                </p>

                                <div class="mt-auto d-flex gap-2">

                                    <a href="{{ route('admin.eventos.edit', $evento->id) }}"
                                       class="btn btn-warning btn-sm w-50">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.eventos.destroy', $evento->id) }}"
                                          method="POST"
                                          class="w-50">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm w-100">
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center text-muted py-5">
                <h4>No hay eventos cargados</h4>
            </div>

        @endif

    </div>

</div>

@endsection