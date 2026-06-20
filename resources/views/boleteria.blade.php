@extends('plantilla')

@section('content')

<div class="container py-5 contacto-section">

    <!-- TÍTULO -->
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1 class="titulo-eventos">🎟️ Boletería</h1>

            <p class="subtitulo-login">
                Conocé nuestras formas de entrega, medios de pago y tiempos de gestión.
            </p>
        </div>
    </div>

    <!-- INTRO -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="card login-card shadow-sm border-0">
                <div class="card-body">
                    <p class="texto-justificado mb-0">
                        En la boletería del Teatro de la Ciudad podés adquirir entradas de manera digital o presencial,
                        con distintos medios de pago y entrega inmediata según el tipo de compra.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CARDS PRINCIPALES -->
    <div class="row g-4">

        <!-- ENTREGA -->
        <div class="col-md-6">
            <div class="card login-card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h4 class="text-center text-purple fw-bold mb-4">
                        📧 Tipos de Entrega
                    </h4>

                    <p class="texto-justificado mb-3">
                        <strong>Entrada digital:</strong> Se envía por correo electrónico inmediatamente luego de la compra.
                    </p>

                    <p class="texto-justificado mb-0">
                        <strong>Sticker QR:</strong> Código de acceso digital para ingreso al evento.
                    </p>

                </div>

            </div>
        </div>

        <!-- PAGO -->
        <div class="col-md-6">
            <div class="card login-card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h4 class="text-center text-purple fw-bold mb-4">
                        💳 Medios de Pago
                    </h4>

                    <ul class="list-unstyled texto-justificado mb-0">
                        <li class="mb-2">💳 Tarjetas de crédito (Visa / Mastercard)</li>
                        <li class="mb-2">💳 Tarjetas de débito</li>
                        <li class="mb-2">📱 Mercado Pago</li>
                        <li class="mb-2">📲 QR Mercado Pago</li>
                    </ul>

                </div>

            </div>
        </div>

    </div>

    <!-- TIEMPOS -->
    <div class="row mt-4">

        <div class="col-12">

            <div class="card login-card shadow-sm border-0">

                <div class="card-body">

                    <h4 class="text-center text-purple fw-bold mb-4">
                        ⏰ Tiempos de Entrega
                    </h4>

                    <p class="texto-justificado mb-0">
                        Las entradas digitales se envían de forma inmediata una vez confirmada la compra.
                        Podés acceder a tu ticket desde tu correo o cuenta registrada.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- ALERTA -->
    <div class="row mt-4">

        <div class="col-12">

            <div class="card login-card border-0 shadow-sm">

                <div class="card-body text-center">

                    <p class="mb-0 text-muted">
                        📢 <strong>Importante:</strong> Los precios pueden incluir cargos de servicio.
                        Consultá promociones bancarias disponibles.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection