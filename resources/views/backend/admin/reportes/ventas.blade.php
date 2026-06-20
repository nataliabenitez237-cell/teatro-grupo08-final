@extends('plantilla')

@section('content')

<div class="container py-4">

    <a href="/admin" class="btn btn-outline-secondary mb-4">
        ← Volver
    </a>

    <div class="text-center mt-4 mb-5">

        <h2 class="titulo-eventos mb-1">
            📊 Reporte de Ventas
        </h2>

        <p class="contacto-subtitulo mb-0">
            Resumen general de ventas e ingresos
        </p>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        🎟 Entradas Vendidas
                    </h6>

                    <h2 class="fw-bold mb-0">
                        {{ $totalEntradas }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        💰 Recaudación Total
                    </h6>

                    <h2 class="fw-bold text-success mb-0">
                        ${{ number_format($totalRecaudado, 0, ',', '.') }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        💳 Comisiones
                    </h6>

                    <h2 class="fw-bold text-warning mb-0">
                        ${{ number_format($totalComisiones, 0, ',', '.') }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        📈 Ganancia Neta
                    </h6>

                    <h2 class="fw-bold text-primary mb-0">
                        ${{ number_format($gananciaNeta, 0, ',', '.') }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    {{-- TOTAL DE COMPRAS --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body text-center">

            <h5 class="mb-2">
                🛒 Compras Realizadas
            </h5>

            <h3 class="fw-bold">
                {{ $totalCompras }}
            </h3>

        </div>

    </div>

    {{-- DETALLE POR EVENTO --}}
    <div class="card shadow border-0">

        <div class="card-body">

            <h5 class="text-center text-purple fw-bold mb-4"">
                📋 Detalle por Evento
            </h5>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th class="text-center">Entradas Vendidas</th>
                            <th class="text-end">Recaudado</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($resumenEventos as $item)

                            <tr>

                                <td class="fw-semibold">
                                    {{ $item->evento->nombre ?? 'Evento no disponible' }}
                                </td>

                                <td class="text-center">
                                    {{ $item->total_entradas ?? 0}}
                                </td>

                                <td class="text-end text-success fw-bold">
                                    ${{ number_format($item->total_recaudado ?? 0, 0, ',', '.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No hay ventas registradas.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection