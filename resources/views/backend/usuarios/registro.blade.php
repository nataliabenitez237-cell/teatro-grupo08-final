@extends('plantilla')

@section('content')

<div class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12 col-md-8 col-lg-6">

                <h2 class="text-center mb-2 titulo-eventos">
                    📝 Crear Cuenta
                </h2>

                <p class="text-center subtitulo-login mb-4">
                    Creá tu cuenta para empezar a comprar entradas
                </p>

                <div class="card login-card shadow-lg border-0">

                    <div class="card-body p-4 p-md-5">

                        <form action="/registro" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold fst-italic">
                                    Nombre:
                                </label>
                                <input type="text" name="name" class="form-control input-login" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold fst-italic">
                                    Apellido:
                                </label>
                                <input type="text" name="apellido" class="form-control input-login" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold fst-italic">
                                    Email:
                                </label>
                                <input type="email" name="email" class="form-control input-login" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold fst-italic">
                                    Contraseña:
                                </label>
                                <input type="password" name="password" class="form-control input-login" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold fst-italic">
                                    Confirmar contraseña:
                                </label>
                                <input type="password" name="password_confirmation" class="form-control input-login" required>
                            </div>

                            <button type="submit" class="btn btn-login w-100">
                                Registrarse
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="/login" class="link-login">
                                ¿Ya tenés cuenta? Iniciá sesión
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection