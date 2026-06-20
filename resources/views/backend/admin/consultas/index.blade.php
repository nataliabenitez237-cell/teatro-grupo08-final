@extends('plantilla')

@section('content')

<div class="container py-4">

    {{-- TÍTULO --}}
    <div class="text-center mt-3 mb-4">

        <h2 class="titulo-eventos mb-2">
            📩 Consultas de Usuarios
        </h2>

        <p class="contacto-subtitulo mb-0">
            Administrá y revisá las consultas recibidas desde el sitio web
        </p>

    </div>

    {{-- ALERTA --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTROS --}}
    <div class="card login-card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('admin.consultas.index') }}">

                <div class="row g-3">

                    <div class="col-md-4">
                        <input type="text"
                               name="buscar"
                               class="form-control"
                               placeholder="Buscar por nombre o email"
                               value="{{ request('buscar') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="estado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>
                                No leídas
                            </option>
                            <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>
                                Leídas
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="tipo_consulta" class="form-select">
                            <option value="">Todos los tipos</option>
                            <option value="Entradas">Entradas</option>
                            <option value="Eventos">Eventos</option>
                            <option value="Talleres">Talleres</option>
                            <option value="Reclamos">Reclamos</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-login w-100">
                            Filtrar
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- TABLA --}}
    <div class="card login-card shadow border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($consultas as $consulta)

                            <tr>

                                <td>{{ $consulta->id }}</td>
                                <td class="fw-semibold">{{ $consulta->nombre }}</td>
                                <td>{{ $consulta->email }}</td>
                                <td>{{ $consulta->tipo_consulta ?? '-' }}</td>

                                <td>
                                    {{ \Illuminate\Support\Str::limit($consulta->mensaje, 50) }}
                                </td>

                                <td>
                                    {{ $consulta->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td>
                                    @if($consulta->leido)
                                        <span class="badge bg-success">Leída</span>
                                    @else
                                        <span class="badge bg-warning text-dark">No leída</span>
                                    @endif
                                </td>

                                <td>

                                    <div class="d-flex flex-column gap-2">

                                        @if(!$consulta->leido)
                                            <form action="{{ route('admin.consultas.leida', $consulta->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-sm btn-success">
                                                    Marcar leída
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.consultas.destroy', $consulta->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Eliminar esta consulta?')">
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-muted py-4">
                                    No se encontraron consultas.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $consultas->links() }}
            </div>

        </div>

    </div>

</div>

@endsection