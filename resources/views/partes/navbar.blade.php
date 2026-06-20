<nav class="navbar navbar-expand-lg" style="background-color: purple; margin: 0; padding: 0.5rem 1rem;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">🎭 Teatro de la Ciudad</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('eventos.todos') }}">🎭 Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/talleres">Talleres</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        Más Info
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/contacto">📞 Contacto</a></li>
                        <li><a class="dropdown-item" href="/quienes-somos">👥 Quiénes Somos</a></li>
                        <li><a class="dropdown-item" href="/terminos">📜 Términos y Usos</a></li>
                        <li><a class="dropdown-item" href="/boleteria">🎟️ Boletería</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->rol_id == 1)
                                <li><a class="dropdown-item" href="/admin">👑 Panel Admin</a></li>
                                <li><a class="dropdown-item" href="/admin/eventos">🎟️ Gestionar Eventos</a></li>
                                <li><a class="dropdown-item" href="/admin/consultas">📩 Ver Consultas</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.usuarios.index') }}">👥 Ver Usuarios</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.reportes.ventas') }}">📊 Ver Ventas</a></li>
                            @else
                                <li><a class="dropdown-item" href="/cliente">👤 Mi Cuenta</a></li>
                                <li><a class="dropdown-item" href="/cliente/historial">📜 Historial de compras</a></li>
                            @endif
                            <li><a class="dropdown-item" href="/carrito">🛒 Mi Carrito</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/login">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/registro">Registrarse</a>
                    </li>
                @endauth
            </ul>

            <!-- BUSCADOR -->
            <form class="d-flex" role="search" action="/buscar" method="GET">
                <input class="form-control me-2" type="search" name="q" placeholder="Buscar eventos" aria-label="Buscar">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>