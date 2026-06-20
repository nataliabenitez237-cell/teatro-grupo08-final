@extends('plantilla')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: #2d3748;">🎨 Talleres</h1>
        <p class="text-muted fs-5">Conocé nuestros talleres artísticos y sumate a las actividades.</p>
    </div>

    <div class="row g-4">
        @forelse($talleres as $taller)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
                @if($taller->imagen)
                <img src="{{ asset('img/talleres/' . $taller->imagen) }}" class="card-img-top" alt="{{ $taller->nombre }}" style="height: 220px; object-fit: cover;">
                @else
                <div style="height: 220px; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: white; font-size: 60px;">🎭</div>
                @endif
                <div class="card-body text-center">
                    <h5 class="fw-bold">{{ $taller->nombre }}</h5>
                    @if($taller->categoria)
                    <span class="badge" style="background: #6c63ff;">{{ $taller->categoria }}</span>
                    @endif
                    <div class="row mt-3">
                        <div class="col-6">
                            <small class="text-muted">Precio</small>
                            <p class="fw-bold text-success">${{ number_format($taller->precio, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Cupos</small>
                            <p class="fw-bold">{{ $taller->cupos_disponibles ?? 0 }}</p>
                        </div>
                    </div>
                    
                    {{-- BOTÓN WHATSAPP --}}
                    <a href="https://wa.me/5493794699617?text=Hola!%20Quiero%20inscribirme%20al%20taller%20de%20{{ urlencode($taller->nombre) }}%20y%20necesito%20más%20información." 
                       target="_blank" 
                       class="btn w-100 fw-bold" 
                       style="background: #25D366; color: white; border: none; padding: 10px; border-radius: 8px; text-decoration: none; display: inline-block;">
                        💬 Consultar por WhatsApp
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No hay talleres disponibles en este momento.</p>
        </div>
        @endforelse
    </div>

    {{-- PAGINACIÓN MEJORADA --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $talleres->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection