@extends('plantilla')

@section('content')

<div class="login-section py-5">
    <div class="container">

        <h2 class="text-center mb-2 titulo-eventos">
            🛠️ Panel de Administración
        </h2>

        <p class="text-center subtitulo-login mb-5">
            Gestioná el contenido y las consultas del Teatro de la Ciudad
        </p>

        <div class="row g-4 justify-content-center">

            <div class="col-md-5">
                <div class="card login-card shadow-lg border-0 h-100">
                    <div class="card-body text-center p-4">
                        <div class="display-4 mb-3">🎟️</div>

                        <h4 class="fw-bold">
                            Eventos
                        </h4>

                        <p class="text-muted">
                            Crear, editar y administrar los eventos disponibles.
                        </p>

                        <a href="/admin/eventos" class="btn btn-login w-100">
                            Gestionar Eventos
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card login-card shadow-lg border-0 h-100">
                    <div class="card-body text-center p-4">
                        <div class="display-4 mb-3">📩</div>

                        <h4 class="fw-bold">
                            Consultas
                        </h4>

                        <p class="text-muted">
                            Revisá y administrá los mensajes enviados por los usuarios.
                        </p>

                        <a href="/admin/consultas" class="btn btn-login w-100">
                            Ver Consultas
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection