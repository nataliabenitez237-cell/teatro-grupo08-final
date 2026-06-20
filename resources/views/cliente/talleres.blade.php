@extends('plantilla')

@section('content')

<div class="container py-5">

    <h2 class="text-center titulo-eventos mb-5">
        🎨 Mis Talleres Inscriptos
    </h2>

    @if($inscripciones->count() > 0)

        <div class="row g-4">

            @foreach($inscripciones as $inscripcion)

                @php
                    $taller = $inscripcion->taller;
                @endphp

                <div class="col-md-4">

                    <div class="card evento-card h-100 shadow-sm border-0">

                        {{-- IMAGEN SEGURA --}}
                        <img src="{{ $taller->imagen 
                                    ? asset('img/talleres/' . $taller->imagen) 
                                    : asset('img/default.jpg') }}"
                             class="evento-img"
                             alt="{{ $taller->nombre }}">

                        <div class="card-body text-center d-flex flex-column">

                            <h5 class="fw-bold">
                                {{ $taller->nombre }}
                            </h5>

                            <p class="text-muted mb-1">
                                {{ $taller->descripcion }}
                            </p>

                            <p class="text-muted small mb-2">
                                📅 {{ $taller->dias_horarios }}
                            </p>

                            <p class="text-muted small mb-3">
                                💰 ${{ number_format($taller->precio, 0, ',', '.') }}
                            </p>

                            <span class="badge bg-success mb-3">
                                Inscripto ✔
                            </span>

                            {{-- CANCELAR INSCRIPCIÓN --}}
                            <form action="{{ route('talleres.cancelar', $taller->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Querés cancelar tu inscripción?')"
                                  class="mt-auto">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger w-100">
                                    Cancelar inscripción
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center text-muted py-5">
            <h4>No estás inscripto en ningún taller</h4>
        </div>

    @endif

</div>

@endsection