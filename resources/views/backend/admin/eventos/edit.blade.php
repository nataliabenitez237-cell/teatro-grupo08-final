@extends('plantilla')

@section('content')

<div class="container py-4">
    <a href="{{ route('admin.eventos.index') }}"
    class="btn btn-outline-secondary mb-3">
        ← Volver a Gestión de Eventos
    </a>

    <h2 class="text-center mb-2 titulo-eventos">
        ✏️ Editar Evento
    </h2>

    <p class="text-center subtitulo-login mb-4">
        Modificá la información del evento seleccionado
    </p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow border-0">

        <div class="card-body p-4">

            <form action="{{ route('admin.eventos.update', $evento->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-bold">
                            Nombre *
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            value="{{ old('nombre', $evento->nombre) }}"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Precio *
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="precio"
                            class="form-control"
                            value="{{ old('precio', $evento->precio) }}"
                            required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Fecha *
                        </label>

                        <input
                            type="date"
                            name="fecha"
                            class="form-control"
                            value="{{ old('fecha', $evento->fecha) }}"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Hora *
                        </label>

                        <input
                            type="time"
                            name="hora"
                            class="form-control"
                            value="{{ old('hora', $evento->hora) }}"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Stock total *
                        </label>

                        <input
                            type="number"
                            name="stock_total"
                            min="1"
                            class="form-control"
                            value="{{ old('stock_total', $evento->stock_total) }}"
                            required>
                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        class="form-control">{{ old('descripcion', $evento->descripcion) }}</textarea>

                </div>

                <div class="row align-items-center">

                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-bold">
                            Imagen actual
                        </label>

                        @if($evento->imagen)

                            <img
                                src="{{ asset('img/proxEventos/' . $evento->imagen) }}"
                                class="img-fluid rounded shadow-sm border">

                        @else

                            <p class="text-muted">
                                Sin imagen
                            </p>

                        @endif

                    </div>

                    <div class="col-md-8 mb-3">

                        <label class="form-label fw-bold">
                            Cambiar imagen
                        </label>

                        <input
                            type="file"
                            name="imagen"
                            class="form-control"
                            accept=".jpg,.jpeg,.png">

                        <small class="text-muted">
                            Dejar vacío para mantener la imagen actual.
                        </small>

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Estado *
                    </label>

                    <select
                        name="activo"
                        class="form-select"
                        required>

                        <option value="1"
                            {{ old('activo', $evento->activo) == 1 ? 'selected' : '' }}>
                            🟢 Activo
                        </option>

                        <option value="0"
                            {{ old('activo', $evento->activo) == 0 ? 'selected' : '' }}>
                            🟡 Inactivo
                        </option>

                    </select>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.eventos.index') }}"
                    class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-login">
                        💾 Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
