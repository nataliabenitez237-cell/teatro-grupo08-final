@extends('plantilla')

@section('content')

<div class="container mt-4">

    <div class="text-center mb-4 mt-5">
        <h2 class="titulo-eventos">📋 Gestión de Eventos</h2>
        <p class="contacto-subtitulo mb-0">
            Administrá eventos del sistema
        </p>
    </div>

    {{-- FILTROS --}}
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">

        <a href="{{ route('admin.eventos.index') }}"
        class="btn btn-outline-primary">
            Todos
        </a>

        <a href="{{ route('admin.eventos.index', ['estado' => 'activos']) }}"
        class="btn btn-outline-success">
            Activos
        </a>

        <a href="{{ route('admin.eventos.index', ['estado' => 'inactivos']) }}"
        class="btn btn-outline-warning">
            Inactivos
        </a>

        <a href="{{ route('admin.eventos.index', ['estado' => 'eliminados']) }}"
        class="btn btn-outline-danger">
            Eliminados
        </a>

    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.eventos.create') }}"
        class="btn btn-success">
            + Nuevo Evento
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-hover align-middle text-center">

            <thead class="bg-purple text-white">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Precio</th>
                    <th>Disponibles</th>
                    <th>Vendidas</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($eventos as $evento)

                    <tr>

                        <td>{{ $evento->id }}</td>

                        <td>
                            @if($evento->imagen)
                                <img src="{{ asset('img/proxEventos/' . $evento->imagen) }}"
                                     class="evento-img">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>

                        <td class="fw-bold">
                            {{ $evento->nombre }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                        </td>

                        <td class="text-success fw-bold">
                            ${{ number_format($evento->precio, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $evento->stock_disponible }}
                        </td>

                        <td>
                            {{ $evento->stock_total - $evento->stock_disponible }}
                        </td>

                        <td>

                            @if($evento->trashed())
                                <span class="badge bg-danger">Eliminado</span>

                            @elseif($evento->activo)
                                <span class="badge bg-success">🟢 Activo</span>

                            @else
                                <span class="badge bg-warning text-dark">🟡 Inactivo</span>
                            @endif

                        </td>

                        <td class="text-nowrap">

                            @if(!$evento->trashed())

                                <a href="{{ route('admin.eventos.edit', $evento->id) }}"
                                class="btn btn-sm btn-warning">
                                    ✏ Editar
                                </a>

                                <form action="{{ route('admin.eventos.destroy', $evento->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Desea dar de baja este evento?')">
                                        📦 Baja
                                    </button>

                                </form>

                            @else

                                <form action="{{ route('admin.eventos.restore', $evento->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    <button type="submit"
                                            class="btn btn-sm btn-success">
                                        ♻ Restaurar
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="text-muted py-4">
                            No hay eventos para mostrar
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- =========================
        PAGINACIÓN BONITA
    ========================== --}}
    <div class="d-flex justify-content-center mt-4">

        {{ $eventos->links('pagination::bootstrap-5') }}

    </div>

</div>

@endsection