<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Órdenes</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f4f6fb; padding: 40px 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .header h1 { color: #333; }
        .header a { background: #667eea; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: bold; }
        .order { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 24px; margin-bottom: 20px; }
        .order-head { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 12px; margin-bottom: 12px; }
        .order-head .num { font-weight: bold; color: #333; }
        .order-head .cliente { color: #888; font-size: 14px; }
        .item-line { display: flex; justify-content: space-between; padding: 6px 0; color: #666; font-size: 14px; }
        .order-total { text-align: right; font-size: 18px; font-weight: bold; color: #667eea; margin-top: 12px; padding-top: 12px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Todas las Órdenes</h1>
            <a href="/admin/products">← Volver a productos</a>
        </div>

        @forelse ($orders as $order)
            <div class="order">
                <div class="order-head">
                    <span class="num">Orden #{{ $order->id }}</span>
                    <span class="cliente">Cliente: {{ $order->user->name }} ({{ $order->user->email }})</span>
                </div>
                @foreach ($order->items as $item)
                    <div class="item-line">
                        <span>{{ $item->quantity }} x {{ $item->product->name }}</span>
                        <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>
                @endforeach
                <div class="order-total">Total: ${{ number_format($order->total, 2) }}</div>
            </div>
        @empty
            <p style="text-align:center; color:#888; padding:40px;">Aún no hay órdenes.</p>
        @endforelse
    </div>
</body>
</html>