<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .ticket {
            width: 58mm; /* Ancho típico de impresoras térmicas */
            margin: 0 auto;
        }
        .header {
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0;
        }
        .header p {
            margin: 0;
        }
        .content {
            text-align: left;
            margin-top: 10px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th, .content td {
            text-align: left;
            padding: 0px 2px 2px 0;
        }
        .content th {
            border-bottom: 1px solid #000;
        }
        .footer {
            margin-top: 6px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>Zule Store</h1>
            <p>Jr. Yahuarhuaca #620</p>
            <p>Teléfono: 979125789</p>
            <p>Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p>Ticket ID: {{ $order->id }}</p>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Cant</th>
                        <th>P. Unit</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->barcode }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ config('settings.currency_symbol') }} {{ number_format($item->price / $item->quantity, 2) }}</td>
                        <td>{{ config('settings.currency_symbol') }} {{ number_format($item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Total: {{ config('settings.currency_symbol') }} {{ number_format($order->formattedTotal(), 2) }}</p>
            <p>¡Gracias por su compra!</p>
        </div>
    </div>
</body>
</html>
