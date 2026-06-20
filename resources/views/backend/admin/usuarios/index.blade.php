@extends('plantilla')

@section('content')

<div class="container py-5">

    <a href="/admin" class="btn btn-outline-secondary mb-3">
        ← Volver al Panel de Administrador
    </a>

    {{-- TÍTULO --}}
    <div class="text-center mb-4">

        <h2 class="titulo-eventos mb-1">
            👥 Usuarios Registrados
        </h2>

        <p class="contacto-subtitulo mb-0">
            Gestión de usuarios del sistema
        </p>

    </div>

    {{-- BUSCADOR COMPACTO --}}
    <form method="GET" class="mb-3 d-flex justify-content-center">

        <div style="max-width: 420px; width: 100%;">

            <div class="input-group input-group-sm">

                <input type="text"
                       name="buscar"
                       class="form-control"
                       placeholder="Buscar  email"
                       value="{{ request('buscar') }}">

                <button class="btn btn-primary">
                    Buscar
                </button>

            </div>

        </div>

    </form>

    {{-- TOTAL (CORREGIDO) --}}
    <div class="row justify-content-center mb-4">

        <div class="col-md-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        Total usuarios
                    </h6>

                    <h2 class="fw-bold mb-0">
                        {{ $usuarios->count() }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    {{-- MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- BOTÓN --}}
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-success mb-3">
        + Nuevo usuario
    </a>

    {{-- TABLA --}}
    <div class="table-responsive">

        <table class="table table-hover align-middle text-center">

            <thead class="bg-purple text-white">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($usuarios as $usuario)

                    <tr>

                        <td>{{ $usuario->id }}</td>

                        <td class="fw-semibold">
                            {{ $usuario->name }} {{ $usuario->apellido }}
                        </td>

                        <td>{{ $usuario->email }}</td>

                        <td>
                            @if($usuario->rol_id == 1)
                                <span class="badge bg-dark px-3 py-2">
                                    Administrador
                                </span>
                            @else
                                <span class="badge bg-light text-dark px-3 py-2">
                                    Cliente
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($usuario->trashed())
                                <span class="badge bg-danger">
                                    Eliminado
                                </span>
                            @else
                                <span class="badge bg-success">
                                    Activo
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $usuario->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-nowrap">

                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                Editar
                            </a>

                            @if(!$usuario->trashed())

                                @if($usuario->id !== auth()->id() && $usuario->rol_id != 1)

                                    <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Dar de baja este usuario?')">
                                            Baja
                                        </button>

                                    </form>

                                @else

                                    <span class="text-muted small">
                                        No permitido
                                    </span>

                                @endif

                            @else

                                <form action="{{ route('admin.usuarios.restore', $usuario->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-sm btn-outline-success">
                                        Restaurar
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-muted py-4">
                            No hay usuarios registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINACIÓN ELIMINADA --}}
    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->appends(request()->all())->links() }}
    </div> --}}

</div>

@endsection