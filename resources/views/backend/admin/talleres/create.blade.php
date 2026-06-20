@extends('plantilla')

@section('content')

<div class="container py-4">

    <a href="{{ route('admin.talleres.index') }}"
       class="btn btn-outline-secondary mb-3">
        ← Volver a Gestión de Talleres
    </a>

    <h2 class="text-center mb-2 titulo-eventos">
        Crear Taller
    </h2>

    <p class="text-center subtitulo-login mb-4">
        Completá la información del nuevo taller
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

            <form action="{{ route('admin.talleres.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-bold">Nombre *</label>

                        <input type="text"
                               name="nombre"
                               class="form-control"
                               value="{{ old('nombre') }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Precio *</label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="precio"
                               class="form-control"
                               value="{{ old('precio') }}"
                               required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-bold">Días / Horarios *</label>

                        <input type="text"
                               name="dias_horarios"
                               class="form-control"
                               value="{{ old('dias_horarios') }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Cupos totales *</label>

                        <input type="number"
                               name="cupos_totales"
                               min="1"
                               class="form-control"
                               value="{{ old('cupos_totales') }}"
                               required>
                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-bold">Descripción</label>

                    <textarea name="descripcion"
                              rows="4"
                              class="form-control">{{ old('descripcion') }}</textarea>

                </div>

                <div class="row align-items-center">

                    <div class="col-md-8 mb-3">

                        <label class="form-label fw-bold">Imagen</label>

                        <input type="file"
                               name="imagen"
                               class="form-control"
                               accept=".jpg,.jpeg,.png">

                        <small class="text-muted">
                            Formatos permitidos: JPG, JPEG y PNG.
                        </small>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-bold">Estado *</label>

                        <select name="activo"
                                class="form-select"
                                required>

                            <option value="1" selected>
                                🟢 Activo
                            </option>

                            <option value="0">
                                🟡 Inactivo
                            </option>

                        </select>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.talleres.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-login">
                        💾 Guardar taller
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection