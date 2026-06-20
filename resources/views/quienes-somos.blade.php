@extends('plantilla')

@section('content')

<div class="container py-5 contacto-section">

    <!-- TÍTULO -->
    <div class="row">
        <div class="col-12 text-center mb-3">
            <h1 class="titulo-eventos">
                🎭 Quiénes Somos
            </h1>

            <p class="subtitulo-login">
                Conocé nuestra historia, valores y el equipo que hace posible cada experiencia cultural.
            </p>

        </div>
    </div>

    <!-- INTRODUCCIÓN -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="card login-card shadow-sm border-0">
                <div class="card-body">
                    <p class="texto-justificado mb-0">
                        Desde hace más de dos décadas trabajamos para acercar el arte, la cultura y el entretenimiento a nuestra comunidad, ofreciendo espacios de encuentro, formación y expresión para artistas y espectadores.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- HISTORIA / MISIÓN -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card login-card shadow-lg border-0 h-100">
                <div class="card-body">
                    <h4 class="text-center text-purple fw-bold mb-4">
                        📖 Nuestra Historia
                    </h4>
                    <p class="texto-justificado">
                        El Teatro de la Ciudad abrió sus puertas en 1995 con la misión de acercar la cultura y las artes escénicas a toda la comunidad.
                    </p>
                    <p class="texto-justificado mb-0">
                        Con más de 25 años de trayectoria, nos consolidamos como uno de los teatros más importantes de la región, recibiendo a artistas nacionales e internacionales.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="card login-card shadow-lg border-0 h-100">

                <div class="card-body">

                    <h4 class="text-center text-purple fw-bold mb-4">
                        🎯 Misión y Visión
                    </h4>

                    <p class="fw-bold mb-1">
                        Misión
                    </p>

                    <p class="texto-justificado">
                        Promover la cultura y las artes escénicas, ofreciendo una programación diversa y de calidad, accesible para todos los públicos.
                    </p>

                    <p class="fw-bold mt-4 mb-1">
                        Visión
                    </p>

                    <p class="texto-justificado mb-0">
                        Ser reconocidos como el teatro referente de la ciudad, impulsando nuevas expresiones artísticas y formando nuevas audiencias.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- EQUIPO -->
    <div class="row mt-5">

        <div class="col-12 text-center mb-4">

            <h3 class="titulo-eventos">
                🌟 Nuestro Equipo
            </h3>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card login-card shadow-lg border-0 text-center h-100">

                <div class="card-body">

                    <img src="{{ asset('img/equipo/equipo1.jfif') }}"
                         alt="María González"
                         class="equipo-img mb-3">

                    <h5 class="fw-bold">
                        María González
                    </h5>

                    <p class="text-muted mb-0">
                        Directora Artística
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card login-card shadow-lg border-0 text-center h-100">

                <div class="card-body">

                    <img src="{{ asset('img/equipo/equipo3.jfif') }}"
                         alt="Carlos Rodríguez"
                         class="equipo-img mb-3">

                    <h5 class="fw-bold">
                        Carlos Rodríguez
                    </h5>

                    <p class="text-muted mb-0">
                        Gerente General
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card login-card shadow-lg border-0 text-center h-100">

                <div class="card-body">

                    <img src="{{ asset('img/equipo/equipo2.jfif') }}"
                         alt="Laura Fernández"
                         class="equipo-img mb-3">

                    <h5 class="fw-bold">
                        Laura Fernández
                    </h5>

                    <p class="text-muted mb-0">
                        Coordinadora de Eventos
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- VALORES -->
    <div class="row mt-5">

        <div class="col-12 text-center mb-4">

            <h3 class="titulo-eventos">
                💜 Nuestros Valores
            </h3>

        </div>

        <div class="col-md-3 mb-3">
            <div class="card login-card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h4 class="mb-3">🎭</h4>
                    <h5>Independencia</h5>
                    <p class="small mb-0">Cultural y artística</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card login-card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h4 class="mb-3">📚</h4>
                    <h5>Formación</h5>
                    <p class="small mb-0">Capacitación constante</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card login-card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h4 class="mb-3">🤝</h4>
                    <h5>Inclusión</h5>
                    <p class="small mb-0">Acceso a la cultura</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card login-card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h4 class="mb-3">🌐</h4>
                    <h5>Redes</h5>
                    <p class="small mb-0">Trabajo con otros espacios</p>
                </div>
            </div>
        </div>

    </div>

    <!-- LOGROS -->
    <div class="row mt-5">

        <div class="col-12 text-center mb-4">

            <h3 class="titulo-eventos">
                🏆 Logros Destacados 2024
            </h3>

        </div>

        <div class="col-md-6 mb-3">

            <div class="card login-card shadow-lg border-0">

                <div class="card-body">

                    <h5 class="text-purple fw-bold mb-3">
                        📊 Actividad anual
                    </h5>

                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">✅ Más de <strong>100 funciones</strong></li>
                        <li class="mb-2">✅ <strong>59 obras de teatro</strong></li>
                        <li class="mb-2">✅ <strong>30 espectáculos de danza</strong></li>
                        <li>✅ <strong>15 shows musicales</strong></li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="card login-card shadow-lg border-0">

                <div class="card-body">

                    <h5 class="text-purple fw-bold mb-3">
                        🏆 Reconocimientos
                    </h5>

                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">✅ <strong>13° Festival Mandarinas al Sol</strong></li>
                        <li class="mb-2">✅ <strong>38° Fiesta Provincial del Teatro</strong></li>
                        <li class="mb-2">✅ Más de <strong>500 alumnos</strong> en talleres</li>
                        <li>✅ Biblioteca Teatral Dante Cena</li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

    <!-- MÉTRICAS -->
    <div class="row mt-5">

        <div class="col-12 text-center mb-4">

            <h3 class="titulo-eventos">
                👥 Más sobre nuestro equipo
            </h3>

        </div>

        <div class="col-md-4 mb-3">
            <div class="card login-card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="metrica-numero">20</div>
                    <div class="metrica-texto">Docentes profesionales</div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card login-card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="metrica-numero">236</div>
                    <div class="metrica-texto">Talleristas 2025</div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card login-card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="metrica-numero">15</div>
                    <div class="metrica-texto">Equipo operativo</div>
                </div>
            </div>
        </div>

    </div>

    <!-- CONTACTO -->
    <div class="row mt-5">

        <div class="col-12">

            <div class="card login-card shadow-lg border-0">

                <div class="card-body text-center contacto-info">

                    <h3 class="mb-4">
                        📞 Información de Contacto
                    </h3>

                    <p>📱 <strong>Instagram / Facebook:</strong> @teatrodelaciudadctes</p>
                    <p>📍 <strong>Dirección:</strong> Pasaje Villanueva 1470, Corrientes</p>
                    <p>📞 <strong>Teléfono:</strong> 3794 75-4083</p>
                    <p class="mb-0">✉️ <strong>Correo:</strong> teatrodelaciudad788@gmail.com</p>

                </div>

            </div>

        </div>

    </div>

    <!-- CIERRE -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card login-card shadow-lg border-0">
                <div class="card-body text-center py-5">
                    <h3 class="mb-3">
                        🎟️ Viví la experiencia del Teatro de la Ciudad
                    </h3>
                    <p class="text-muted mb-4">
                        Descubrí nuestra programación y encontrá el próximo evento para disfrutar junto a nosotros.
                    </p>
                    <a href="/" class="btn btn-login px-4">
                        Ver próximos eventos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection