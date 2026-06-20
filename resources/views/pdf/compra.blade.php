<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factura de Compra</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        .container { padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #2d3748; padding-bottom: 10px; }
        .content { padding: 20px 0; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background: #2d3748; color: white; padding: 10px; text-align: left; }
        .table td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total { font-size: 20px; font-weight: bold; text-align: right; margin-top: 20px; }
        .footer { text-align: center; border-top: 1px solid #ddd; padding-top: 10px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎭 Teatro de la Ciudad</h1>
            <p><strong>Factura de Compra</strong></p>
        </div>

        <div class="content">
            <p><strong>N° de compra:</strong> #{{ $compra->id }}</p>
            <p><strong>Fecha:</strong> {{ $compra->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Cliente:</strong> {{ $compra->user->name }} {{ $compra->user->apellido }}</p>
            <p><strong>Email:</strong> {{ $compra->user->email }}</p>

            <hr>

            <table class="table">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compra->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->evento->nombre ?? 'Evento no disponible' }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                        <td>${{ number_format($detalle->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <p>Total: ${{ number_format($compra->total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="footer">
            <p>Este comprobante es válido como factura. Teatro de la Ciudad.</p>
            <p>Pasaje Villanueva 1470 - Corrientes Capital</p>
        </div>
    </div>
</body>
</html>