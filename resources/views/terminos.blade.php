@extends('plantilla')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            {{-- TÍTULO --}}
            <h1 class="text-center mb-4 titulo-eventos">
                📋 Términos y Condiciones
            </h1>

            <p class="text-center text-muted mb-5">
                Última actualización: 18 de Junio de 2026
            </p>

            {{-- TARJETA --}}
            <div class="card shadow-lg border-0">

                <div class="card-body p-5">

                    {{-- SECCIÓN 1 --}}
                    <h3 class="text-purple fw-bold mb-3">
                        <i class="fas fa-shield-alt me-2"></i>
                        Privacidad
                    </h3>

                    <p class="mb-4">
                        No se comparte con terceros salvo obligación legal. 
                        Tus datos personales están protegidos y serán utilizados 
                        únicamente para la gestión de compras y comunicaciones 
                        relacionadas con el Teatro de la Ciudad.
                    </p>

                    <hr>

                    {{-- SECCIÓN 2 --}}
                    <h3 class="text-purple fw-bold mb-3">
                        <i class="fas fa-ticket-alt me-2"></i>
                        Compra de entradas
                    </h3>

                    <p class="mb-4">
                        Las entradas son personales e <strong>intransferibles</strong>.
                        Es responsabilidad del usuario verificar los datos 
                        <strong>antes de confirmar la compra</strong>. 
                        Una vez confirmada, no se podrán modificar los datos 
                        del comprador ni los eventos seleccionados.
                    </p>

                    <hr>

                    {{-- SECCIÓN 3 --}}
                    <h3 class="text-purple fw-bold mb-3">
                        <i class="fas fa-undo-alt me-2"></i>
                        Devoluciones y cambios
                    </h3>

                    <p>
                        <strong>No se realizan devoluciones</strong> 
                        salvo cancelación del evento por parte del Teatro de la Ciudad.
                    </p>

                    <p class="mb-4">
                        Los cambios están sujetos a disponibilidad y deben 
                        solicitarse con <strong>48 horas de anticipación</strong>.
                        Sujeto a disponibilidad del evento.
                    </p>

                    <hr>

                    {{-- SECCIÓN 4 --}}
                    <h3 class="text-purple fw-bold mb-3">
                        <i class="fas fa-edit me-2"></i>
                        Modificaciones
                    </h3>

                    <p class="mb-0">
                        El Teatro de la Ciudad puede modificar estos términos 
                        en cualquier momento. Las actualizaciones entran en 
                        vigencia desde su publicación en este sitio web.
                    </p>

                    <hr>

                    {{-- SECCIÓN 5 (NUEVA) --}}
                    <h3 class="text-purple fw-bold mb-3">
                        <i class="fas fa-headset me-2"></i>
                        Contacto
                    </h3>

                    <p class="mb-0">
                        Si tenés dudas sobre estos términos, podés 
                        <a href="{{ route('contacto') }}" class="text-purple">
                            contactarnos
                        </a>.
                    </p>

                </div>

            </div>

            {{-- BOTÓN VOLVER --}}
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-login">
                    ← Volver al inicio
                </a>
            </div>

        </div>

    </div>

</div>

@endsection