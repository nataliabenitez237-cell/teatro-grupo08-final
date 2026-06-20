@extends('plantilla')

@section('content')

@php use Carbon\Carbon; @endphp

<div class="container py-5 contacto-section">

    <!-- TÍTULO -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h2 class="titulo-eventos">📜 Mi Historial de Compras</h2>

            <p class="subtitulo-login text-muted fs-5">
                Todas tus compras realizadas
            </p>
        </div>
    </div>

    <!-- FILTROS -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-9">

            <form method="GET" action="{{ route('cliente.historial') }}" class="row g-2">

                <!-- FECHA -->
                <div class="col-md-4">
                    <input type="date" name="fecha" class="form-control"
                           value="{{ request('fecha') }}">
                </div>

                <!-- ID COMPRA -->
                <div class="col-md-4">
                    <input type="number" name="id" class="form-control"
                           placeholder="N° de compra"
                           value="{{ request('id') }}">
                </div>

                <!-- ESTADO -->
                <div class="col-md-4">
                    <select name="estado" class="form-control">
                        <option value="">Estado</option>
                        <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>
                            En proceso
                        </option>
                        <option value="abonado" {{ request('estado') == 'abonado' ? 'selected' : '' }}>
                            Abonado
                        </option>
                        <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>
                            Cancelado
                        </option>
                    </select>
                </div>

                <!-- BOTONES -->
                <div class="col-12 d-flex gap-2 mt-2">
                    <button class="btn btn-primary w-100">
                        Filtrar
                    </button>

                    <a href="{{ route('cliente.historial') }}" class="btn btn-secondary w-100">
                        Limpiar
                    </a>
                </div>

            </form>

        </div>
    </div>

    <!-- LISTADO -->
    <div class="row justify-content-center g-4">

        @forelse($compras as $compra)

            <div class="col-lg-9">

                <div class="card login-card shadow-sm border-0">

                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Compra #{{ $compra->id }}
                                </h5>

                                <small class="text-muted">
                                    {{ Carbon::parse($compra->created_at)->format('d/m/Y H:i') }}
                                </small>
                            </div>

                            <div class="text-end">
                                <strong>Total:</strong><br>
                                ${{ number_format($compra->total, 0, ',', '.') }}
                            </div>

                        </div>

                        <!-- ESTADO -->
                        <div class="mb-3">
                            <span class="badge 
                                {{ $compra->estado == 'abonado' ? 'bg-success' : 
                                   ($compra->estado == 'cancelado' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ ucfirst(str_replace('_', ' ', $compra->estado)) }}
                            </span>
                        </div>

                        <hr>

                        <!-- DETALLES -->
                        <ul class="mb-3 ps-3">
                            @foreach($compra->detalles as $detalle)
                                <li>
                                    🎟 {{ $detalle->evento->nombre ?? 'Evento eliminado' }}
                                    (x{{ $detalle->cantidad }})
                                    - ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                </li>
                            @endforeach
                        </ul>

                        <!-- ACCIONES -->
                        <div class="d-flex gap-2 justify-content-end">

                            <!-- PDF -->
                            <a href="{{ url('/cliente/compras/' . $compra->id . '/pdf') }}"
                               class="btn btn-outline-dark btn-sm">
                              📄  PDF
                            </a>

                            <!-- CANCELAR -->
                            @if($compra->estado == 'en_proceso')
                                <form action="{{ route('cliente.compras.cancelar', $compra->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        Cancelar
                                    </button>
                                </form>

                                <form action="{{ route('compra.confirmar', $compra->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        Confirmar pago
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-lg-9 text-center text-muted">
                <h4>No realizaste ninguna compra aún</h4>
                <p>Explorá nuestros <a href="/">eventos</a> y comprá tu entrada.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection