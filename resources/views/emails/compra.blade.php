<div class="container">

    <div class="header">
        <h2>🎭 Teatro de la Ciudad</h2>
    </div>

    <div class="content">

        <h3>¡Gracias por tu compra, {{ $compra->user->name }}!</h3>

        <p><strong>N° de compra:</strong> #{{ $compra->id }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y H:i') }}</p>

        <hr>

        <h4>Detalle de tu compra:</h4>

        <ul>
            @foreach($compra->detalles as $detalle)
                <li>
                    <strong>{{ $detalle->evento->nombre ?? 'Evento no disponible' }}</strong><br>
                    Cantidad: {{ $detalle->cantidad }} x ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                </li>
            @endforeach
        </ul>

        <hr>

        <p>
            <strong>Total:</strong>
            ${{ number_format($compra->total, 0, ',', '.') }}
        </p>

        <p>¡Disfrutá del evento! Te esperamos.</p>

        <small>Este comprobante es válido como factura. Teatro de la Ciudad.</small>

    </div>

</div>