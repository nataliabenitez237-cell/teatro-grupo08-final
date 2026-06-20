<div style="font-family: Arial, sans-serif; padding: 25px; max-width: 650px; margin: auto;">

    <div style="text-align:center; margin-bottom: 25px;">

        <h1 style="color:#6f42c1; margin-bottom:5px;">
             Teatro de la Ciudad
        </h1>

        <p style="color:#6f42c1; font-size:14px; margin:0;">
            Comprobante oficial de compra
        </p>

    </div>

    <!-- BOX INFO -->
    <div style="border:1px solid #ddd; border-radius:10px; padding:15px; margin-bottom:15px;">

        <p style="margin:5px 0;">
            <strong>Compra #{{ $compra->id }}</strong>
        </p>

        <p style="margin:5px 0;">
            Estado:
            <span style="color:
                {{ $compra->estado == 'abonado' ? 'green' : ($compra->estado == 'cancelado' ? 'red' : '#b8860b') }};
                font-weight:bold;">
                {{ ucfirst(str_replace('_',' ', $compra->estado)) }}
            </span>
        </p>

        <p style="margin:5px 0;">
            Fecha: {{ $compra->created_at->format('d/m/Y H:i') }}
        </p>

    </div>

    <!-- DETALLES -->
    <div style="border:1px solid #ddd; border-radius:10px; padding:15px;">

        <strong>
             Detalles de la compra
        </strong>

        @foreach($compra->detalles as $detalle)
            <p style="margin:6px 0;">
                {{ $detalle->evento->nombre ?? 'Evento eliminado' }}
                — x{{ $detalle->cantidad }}
            </p>
        @endforeach

        <hr>

        <p style="text-align:right; font-size:18px; font-weight:bold; color:#6f42c1;">
            Total: ${{ number_format($compra->total, 0, ',', '.') }}
        </p>

    </div>

    
    <p style="text-align:center; margin-top:20px; font-size:12px; color:#888;">
        Gracias por tu compra · Teatro de la Ciudad
    </p>

</div>