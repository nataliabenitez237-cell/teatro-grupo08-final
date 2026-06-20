@extends('plantilla')

@section('content')

<div class="container mt-5">

    <h2 class="text-center mb-4">📩 Contáctanos</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('consultas.enviar') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono (opcional)</label>
                            <input type="text" name="telefono" id="telefono" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea name="mensaje" id="mensaje" class="form-control" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Enviar consulta</button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection