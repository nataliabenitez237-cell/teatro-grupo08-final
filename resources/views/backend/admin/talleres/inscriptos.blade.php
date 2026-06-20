@extends('plantilla')

@section('content')

@php
    $inscriptos = $taller->inscripciones->count();
    $total = $taller->cupos_totales;
    $ocupacion = $total > 0 ? round(($inscriptos / $total) * 100) : 0;
@endphp

<div class="container py-5">

    <h2 class="text-center titulo-eventos mb-4">
        👥 Inscriptos en: {{ $taller->nombre }}
    </h2>

    {{-- DASHBOARD --}}
    <div class="row mb-4 text-center">

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-1">👥 Total inscriptos</h5>
                <h3 class="text-primary">{{ $inscriptos }}</h3>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-1">🎟️ Cupos disponibles</h5>
                <h3 class="text-success">{{ $taller->cupos_disponibles }}</h3>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-1">📊 Ocupación</h5>
                <h3 class="text-warning">{{ $ocupacion }}%</h3>
            </div>
        </div>

    </div>

    {{-- TABLA --}}
    @if($inscriptos > 0)

        <div class="table-responsive">

            <table class="table table-hover text-center align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Fecha inscripción</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($taller->inscripciones as $inscripcion)

                        <tr>
                            <td>{{ $inscripcion->id }}</td>

                            <td>{{ $inscripcion->user->name ?? 'Sin nombre' }}</td>

                            <td>{{ $inscripcion->user->email ?? '-' }}</td>

                            <td>
                                {{ $inscripcion->created_at?->format('d/m/Y H:i') }}
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="text-center text-muted py-5">
            <h5>No hay inscriptos todavía</h5>
        </div>

    @endif

</div>

@endsection