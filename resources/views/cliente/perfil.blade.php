@extends('plantilla')

@section('content')

<div class="login-section py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12 col-md-9 col-lg-7">

                <h2 class="text-center mb-4 titulo-eventos">
                    ✏️ Editar mi perfil
                </h2>

                <div class="card login-card shadow-lg border-0">

                    <div class="card-body p-4 p-md-5">

                        {{-- MENSAJE --}}
                        @if(session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- FORMULARIO --}}
                        <form method="POST" action="{{ route('cliente.perfil.update') }}">
                            @csrf

                            {{-- NOMBRE --}}
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ $usuario->name }}">
                            </div>

                            {{-- APELLIDO --}}
                            <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text"
                                       name="apellido"
                                       class="form-control"
                                       value="{{ $usuario->apellido }}">
                            </div>

                            {{-- EMAIL --}}
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ $usuario->email }}">
                            </div>

                            {{-- PASSWORD --}}
                            <div class="mb-3">
                                <label class="form-label">Nueva contraseña (opcional)</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Dejar vacío si no querés cambiarla">
                            </div>

                            {{-- BOTÓN --}}
                            <button type="submit" class="btn btn-login w-100">
                                💾 Guardar cambios
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection