@extends('plantilla')

@section('content')

<div class="container py-4">

    {{-- TÍTULO --}}
    <div class="text-center mt-3 mb-4">

        <h2 class="titulo-eventos mb-2">
            🛒 Detalle de Compra
        </h2>

        <p class="contacto-subtitulo mb-0">
            Información completa de la compra seleccionada
        </p>

    </div>

    {{-- DATOS DE LA COMPRA --}}
    <div class="card login-card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>ID:</strong>
                    {{ $compra->id }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Fecha:</strong>
                    {{ $compra->created_at->format('d/m/Y H:i') }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Cliente:</strong>
                    {{ $compra->user->name ?? 'Sin usuario' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Email:</strong>
                    {{ $compra->user->email ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Método de Pago:</strong>
                    {{ $compra->metodoPago->nombre ?? 'No informado' }}
                </div>

                <div class="col-md-6 mb-3">

                    <strong>Estado:</strong>

                    @if($compra->estado == 'confirmada')
                        <span class="badge bg-success">
                            Confirmada
                        </span>
                    @elseif($compra->estado == 'cancelada')
                        <span class="badge bg-danger">
                            Cancelada
                        </span>
                    @else
                        <span class="badge bg-warning text-dark">
                            En proceso
                        </span>
                    @endif

                </div>

                <div class="col-md-12">
                    <strong>Total:</strong>

                    <span class="fw-bold">
                        ${{ number_format($compra->total, 0, ',', '.') }}
                    </span>
                </div>

            </div>

        </div>

    </div>

    {{-- DETALLE DE EVENTOS --}}
    <div class="card login-card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($compra->detalles as $detalle)

                            <tr>

                                <td>
                                    {{ $detalle->evento->nombre ?? 'Evento eliminado' }}
                                </td>

                                <td>
                                    {{ $detalle->cantidad }}
                                </td>

                                <td>
                                    ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                </td>

                                <td>
                                    ${{ number_format($detalle->subtotal, 0, ',', '.') }}
                                </td>

                            </tr>

                        @endforeach

                        {{-- Comisión --}}
                        <tr>

                            <td colspan="3" class="text-end fw-semibold">
                                Comisión de servicio
                            </td>

                            <td>
                                $2.000
                            </td>

                        </tr>

                        {{-- Total --}}
                        <tr class="table-light">

                            <td colspan="3" class="text-end fw-bold">
                                Total
                            </td>

                            <td class="fw-bold">
                                ${{ number_format($compra->total, 0, ',', '.') }}
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- BOTÓN VOLVER --}}
    <div class="text-center mt-4">

        <a href="{{ route('admin.compras.index') }}"
        class="btn btn-login">

            Volver a Compras

        </a>

    </div>

</div>

@endsection
