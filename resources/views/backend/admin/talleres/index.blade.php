@extends('plantilla')

@section('content')

<div class="container py-5">

    <div class="text-center mb-4 mt-3">
        <h2 class="titulo-eventos">🎨 Gestión de Talleres</h2>
        <p class="contacto-subtitulo mb-0">
            Administrá talleres del sistema
        </p>
    </div>

    <div class="d-flex justify-content-between mb-3">

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-secondary">
            ← Volver al panel
        </a>

        <a href="{{ route('admin.talleres.create') }}"
           class="btn btn-success">
            + Nuevo Taller
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
                    <th>Precio</th>
                    <th>Cupos</th>
                    <th>Inscriptos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            @forelse($talleres as $taller)

                <tr>

                    <td>{{ $taller->id }}</td>

                    {{-- IMAGEN --}}
                    <td>
                        @if($taller->imagen)
                            <img src="{{ asset('storage/img/talleres/' . $taller->imagen) }}"
                                 width="70"
                                 height="70"
                                 style="object-fit:cover"
                                 class="rounded">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>

                    <td class="fw-bold">{{ $taller->nombre }}</td>

                    <td class="text-success fw-bold">
                        ${{ number_format($taller->precio,0,',','.') }}
                    </td>

                    <td>
                        {{ $taller->cupos_disponibles }} / {{ $taller->cupos_totales }}
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            {{ $taller->inscripciones_count ?? 0 }}
                        </span>
                    </td>

                    <td>
                        @if($taller->trashed())
                            <span class="badge bg-danger">Eliminado</span>
                        @elseif($taller->activo)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-warning text-dark">Inactivo</span>
                        @endif
                    </td>

                    <td class="text-nowrap">

                        @if(!$taller->trashed())

                            <a href="{{ route('admin.talleres.edit', $taller->id) }}"
                               class="btn btn-sm btn-warning">
                                ✏ Editar
                            </a>

                            <form action="{{ route('admin.talleres.destroy', $taller->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Dar de baja este taller?')">
                                    Baja
                                </button>
                            </form>

                        @else

                            <form action="{{ route('admin.talleres.restore', $taller->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf

                                <button class="btn btn-sm btn-success">
                                    Restaurar
                                </button>
                            </form>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="8" class="text-muted py-4">
                        No hay talleres para mostrar
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection