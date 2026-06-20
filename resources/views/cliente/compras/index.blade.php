@extends('plantilla')

@section('content')

<div class="container py-5 contacto-section">

    <!-- TÍTULO -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="titulo-eventos">🧾 Mis Compras</h1>

            <p class="subtitulo-login text-muted fs-5">
                Historial de compras realizadas
            </p>
        </div>
    </div>

    <!-- INTRO -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="card login-card shadow-sm border-0">
                <div class="card-body">
                    <p class="texto-justificado mb-0">
                        Aquí podés ver todas tus compras, su estado y descargar comprobantes en PDF.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTROS -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-9">

            <div class="card login-card shadow-sm border-0">

                <div class="card-body">

                    <form method="GET" class="row g-2 align-items-center">

                        <div class="col-md-4">
                            <select name="estado" class="form-control">
                                <option value="">Todos los estados</option>
                                <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                                <option value="abonado" {{ request('estado') == 'abonado' ? 'selected' : '' }}>Abonado</option>
                                <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="date" name="desde" value="{{ request('desde') }}" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <input type="date" name="hasta" value="{{ request('hasta') }}" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-login w-100">
                                Filtrar
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

    <!-- LISTADO -->
    <div class="row justify-content-center g-4">

        @forelse($compras as $compra)

            <div class="col-lg-9">

                <div class="card login-card shadow-sm border-0">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Compra #{{ $compra->id }}
                                </h5>

                                <span class="badge {{ $compra->estado == 'abonado' ? 'bg-success' : ($compra->estado == 'cancelado' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ ucfirst(str_replace('_', ' ', $compra->estado)) }}
                                </span>
                            </div>

                            <div class="text-end">
                                <strong>Total:</strong><br>
                                ${{ number_format($compra->total, 0, ',', '.') }}
                            </div>

                        </div>

                        <hr>

                        <ul class="mb-3 ps-3">
                            @foreach($compra->detalles as $detalle)
                                <li>
                                    🎟 {{ $detalle->evento->nombre ?? 'Evento eliminado' }}
                                    - x{{ $detalle->cantidad }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="text-end">

                              <a href="{{ url('/cliente/compras/' . $compra->id . '/pdf') }}"
                                   class="btn btn-sm btn-outline-dark">
                                  📄 PDF
                               </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-lg-9 text-center text-muted">
                No tenés compras todavía.
            </div>

        @endforelse

    </div>

</div>

@endsection