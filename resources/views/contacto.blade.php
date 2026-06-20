@extends('plantilla')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            {{-- TÍTULO --}}
            <h1 class="text-center mb-4 titulo-eventos">
                📧 Contacto
            </h1>

            <p class="text-center text-muted mb-5">
                ¿Tenés alguna consulta? Completá el formulario y te responderemos a la brevedad.
            </p>

            <div class="row g-4">

                {{-- FORMULARIO --}}
                <div class="col-md-6">

                    <div class="card shadow-lg border-0">

                        <div class="card-body p-4 p-md-5">

                            <h4 class="fw-bold mb-4">
                                ✉️ Enviar mensaje
                            </h4>

                            <form action="{{ route('contacto.enviar') }}" method="POST">

                                @csrf

                                {{-- NOMBRE --}}
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-semibold">
                                        Nombre
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="nombre"
                                           name="nombre"
                                           placeholder="Tu nombre"
                                           required>
                                </div>

                                {{-- APELLIDO --}}
                                <div class="mb-3">
                                    <label for="apellido" class="form-label fw-semibold">
                                        Apellido
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="apellido"
                                           name="apellido"
                                           placeholder="Tu apellido"
                                           required>
                                </div>

                                {{-- EMAIL --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        Correo electrónico
                                    </label>
                                    <input type="email"
                                           class="form-control"
                                           id="email"
                                           name="email"
                                           placeholder="tu@email.com"
                                           required>
                                </div>

                                {{-- TELÉFONO --}}
                                <div class="mb-3">
                                    <label for="telefono" class="form-label fw-semibold">
                                        Teléfono
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="telefono"
                                           name="telefono"
                                           placeholder="Ej: 379 123 4567">
                                </div>

                                {{-- MENSAJE --}}
                                <div class="mb-4">
                                    <label for="mensaje" class="form-label fw-semibold">
                                        Mensaje
                                    </label>
                                    <textarea class="form-control"
                                              id="mensaje"
                                              name="mensaje"
                                              rows="5"
                                              placeholder="Escribí tu mensaje aquí..."
                                              required></textarea>
                                </div>

                                {{-- BOTÓN --}}
                                <button type="submit" class="btn btn-login w-100">
                                    📩 Enviar mensaje
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                {{-- INFORMACIÓN DE CONTACTO --}}
                <div class="col-md-6">

                    <div class="card shadow-lg border-0">

                        <div class="card-body p-4 p-md-5">

                            <h4 class="fw-bold mb-4">
                                📍 Información
                            </h4>

                            {{-- DIRECCIÓN --}}
                            <div class="mb-4">
                                <p class="fw-bold mb-1">🏛️ Teatro de la Ciudad</p>
                                <p class="text-muted mb-0">Pasaje Villanueva 1470</p>
                                <p class="text-muted mb-0">Corrientes Capital</p>
                            </div>

                            {{-- CÓMO LLEGAR --}}
                            <div class="mb-4">
                                <p class="fw-bold mb-1">🗺️ Cómo llegar</p>
                                <p class="text-muted mb-2">
                                    Estamos en el centro de la ciudad, entre Catamarca y San Lorenzo.
                                </p>
                                <a href="https://www.google.com/maps?q=Pasaje+Villanueva+1470+Corrientes+Capital"
                                   target="_blank"
                                   class="btn btn-outline-primary btn-sm w-100">
                                    📍 Ver en Google Maps
                                </a>
                            </div>

                            {{-- TELÉFONO --}}
                            <div class="mb-4">
                                <p class="fw-bold mb-1">📞 Teléfono</p>
                                <p class="text-muted mb-0">379-4699617</p>
                            </div>

                            {{-- EMAIL --}}
                            <div class="mb-4">
                                <p class="fw-bold mb-1">✉️ Email</p>
                                <p class="text-muted mb-0">teatrodelaciudad788@gmail.com</p>
                            </div>

                            <hr>

                            {{-- REDES SOCIALES --}}
                            <h5 class="fw-bold mb-3">
                                🌐 Redes sociales
                            </h5>

                            <div class="d-flex gap-3 flex-wrap">

                                {{-- FACEBOOK --}}
                                <a href="https://www.facebook.com/teatrodelaciudadcorrientes" 
                                   target="_blank" 
                                   class="btn btn-outline-primary rounded-circle"
                                   style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px;"
                                   title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                {{-- INSTAGRAM --}}
                                <a href="https://www.instagram.com/teatrodelaciudadctes" 
                                   target="_blank" 
                                   class="btn btn-outline-danger rounded-circle"
                                   style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px;"
                                   title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>

                                {{-- WHATSAPP --}}
                                <a href="https://wa.me/5493794699617" 
                                   target="_blank" 
                                   class="btn btn-outline-success rounded-circle"
                                   style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px;"
                                   title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                {{-- YOUTUBE --}}
                                <a href="https://www.youtube.com/" 
                                   target="_blank" 
                                   class="btn btn-outline-danger rounded-circle"
                                   style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 20px;"
                                   title="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection