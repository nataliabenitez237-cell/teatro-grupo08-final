@extends('plantilla')

@section('content')

<div class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12 col-md-8 col-lg-6">

                <h2 class="text-center mb-2 titulo-eventos">
                    🔐 Iniciar Sesión
                </h2>

                <p class="text-center subtitulo-login mb-4">
                    Accedé a tu cuenta para gestionar tus eventos y compras
                </p>

                @if(session('mensaje') || request()->has('compra'))
                    <div class="alert alert-info text-center shadow-sm">
                        {{ session('mensaje') ?? '🎟️ Debés iniciar sesión o registrarte para comprar entradas.' }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger text-center shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card login-card shadow-lg border-0">

                    <div class="card-body p-4 p-md-5">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">

                                <label class="form-label fw-bold fst-italic">
                                    Email:
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control input-login"
                                       value="{{ old('email') }}"
                                       required>

                            </div>

                            {{-- Contraseña --}}
                            <div class="mb-4">

                                <label class="form-label fw-bold fst-italic">
                                    Contraseña:
                                </label>

                                <div class="position-relative">

                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control input-login pe-5"
                                           required>

                                    <button type="button"
                                            onclick="togglePassword()"
                                            class="btn border-0 bg-transparent position-absolute top-50 end-0 translate-middle-y me-2">
                                        <i id="eyeIcon" class="bi bi-eye"></i>
                                    </button>

                                </div>

                            </div>

                            <button type="submit"
                                    class="btn btn-login w-100">
                                Iniciar Sesión
                            </button>

                        </form>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Para comprar entradas es necesario tener una cuenta.
                            </small>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('registro') }}" class="link-login">
                                ¿No tenés cuenta? Registrate
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection