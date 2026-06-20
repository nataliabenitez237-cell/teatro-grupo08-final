@extends('plantilla')

@section('content')

<div class="container py-4">

    <a href="{{ route('admin.usuarios.index') }}"
       class="btn btn-outline-secondary mb-3">
        ← Volver a Usuarios
    </a>

    {{-- TÍTULO --}}
    <div class="text-center mb-4">

        <h2 class="titulo-eventos mb-1">
            ✏️ Editar Usuario
        </h2>

        <p class="contacto-subtitulo mb-0">
            Modificar datos del usuario
        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            {{-- ERRORES --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="card shadow border-0">

                <div class="card-body p-4">

                    <form action="{{ route('admin.usuarios.update', $usuario->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        {{-- NOMBRE --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Nombre
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $usuario->name) }}"
                                   required>

                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $usuario->email) }}"
                                   required>

                        </div>

                        {{-- ROL SOLO INFORMATIVO --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Rol
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $usuario->rol->nombre }}"
                                   readonly>

                            <small class="text-muted">
                                El rol no puede modificarse desde esta pantalla.
                            </small>

                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between">

                            <a href="{{ route('admin.usuarios.index') }}"
                               class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="btn btn-success">
                                Guardar Cambios
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection