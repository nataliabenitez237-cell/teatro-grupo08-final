@extends('plantilla')

@section('content')

<div class="container py-4">

    {{-- TÍTULO --}}
    <div class="text-center mt-3 mb-4">

        <h2 class="titulo-eventos mb-2">
            🛒 Gestión de Compras
        </h2>

        <p class="contacto-subtitulo mb-0">
            Consultá y gestioná compras en proceso, confirmadas y canceladas
        </p>

    </div>

    {{-- ALERTAS --}}
    @if(session('success'))

        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger shadow-sm">
            {{ session('error') }}
        </div>

    @endif

    {{-- TABLA --}}
    <div class="card login-card shadow-sm border-0">

        <div class="card-body">

            @if($compras->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle text-center">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($compras as $compra)

                                <tr>

                                    {{-- ID --}}
                                    <td>
                                        {{ $compra->id }}
                                    </td>

                                    {{-- CLIENTE --}}
                                    <td class="fw-semibold">
                                        {{ $compra->user->name ?? 'Sin usuario' }}
                                    </td>

                                    {{-- FECHA --}}
                                    <td>
                                        {{ $compra->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    {{-- ESTADO --}}
                                    <td>

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

                                    </td>

                                    {{-- TOTAL --}}
                                    <td>
                                        ${{ number_format($compra->total, 0, ',', '.') }}
                                    </td>

                                    {{-- ACCIONES --}}
                                    <td>

                                        <a href="{{ route('admin.compras.show', $compra->id) }}"
                                        class="btn btn-sm btn-primary">

                                            Ver

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- PAGINACIÓN --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $compras->links() }}
                </div>

            @else

                <div class="text-center text-muted py-4">

                    No hay compras registradas.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
