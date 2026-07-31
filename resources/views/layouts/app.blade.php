<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopCart')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f4f6fb; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 0 32px; display: flex; align-items: center; justify-content: space-between; height: 64px; position: sticky; top: 0; z-index: 100; }
        .navbar .logo { font-size: 20px; font-weight: bold; color: #667eea; text-decoration: none; }
        .navbar .links { display: flex; gap: 8px; align-items: center; }
        .navbar .links a { color: #555; text-decoration: none; padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; transition: background 0.2s; }
        .navbar .links a:hover { background: #f0f2f8; }
        .navbar .links a.active { background: #667eea; color: white; }
        .navbar .cart-link { background: #4caf50 !important; color: white !important; }
        main { max-width: 1000px; margin: 32px auto; padding: 0 20px; }
        .flash { max-width: 1000px; margin: 20px auto; padding: 14px; border-radius: 8px; text-align: center; font-weight: bold; }
        .flash.success { background: #e8f5e9; color: #2e7d32; }
        .flash.error { background: #ffebee; color: #c62828; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/shop" class="logo">🛍️ ShopCart</a>
        <div class="links">
            <a href="/shop">Tienda</a>
            <a href="/orders">Mis Órdenes</a>
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="/admin/products">📦 Admin</a>
                @endif
            @endauth
            <a href="/cart" class="cart-link">🛒 Carrito ({{ array_sum(array_column(session('cart', []), 'quantity')) }})</a>
            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:#f44336; color:white; border:none; padding:8px 16px; border-radius:8px; font-size:14px; font-weight:500; cursor:pointer;">Salir</button>
            </form>
        </div>
    </nav>

    @if (session('success'))
        <div class="flash success">✅ {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash error">⚠️ {{ session('error') }}</div>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>