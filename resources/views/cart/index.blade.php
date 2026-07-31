@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
    <h1 style="color:#333; margin-bottom:24px;">🛒 Mi Carrito</h1>

    <div style="background:white; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:32px;">
        @if (count($cart) > 0)
            @foreach ($cart as $id => $item)
                <div class="item">
                    <div class="item-info">
                        <h3>{{ $item['name'] }}</h3>
                        <span>${{ number_format($item['price'], 2) }} c/u</span>
                        <div class="cantidad">
                            <form action="/cart/decrease/{{ $id }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-cant">−</button>
                            </form>
                            <span class="cant-num">{{ $item['quantity'] }}</span>
                            <form action="/cart/increase/{{ $id }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-cant">+</button>
                            </form>
                        </div>
                    </div>
                    <div class="item-right">
                        <span class="subtotal">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        <form action="/cart/remove/{{ $id }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-remove">Quitar</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="total">Total: ${{ number_format($total, 2) }}</div>

            <div class="acciones">
                <a href="/shop" class="seguir">← Seguir comprando</a>
                <form action="/checkout" method="POST">
                    @csrf
                    <button type="submit" class="btn-comprar">Confirmar compra ✅</button>
                </form>
            </div>
        @else
            <p style="text-align:center; color:#888; padding:40px;">Tu carrito está vacío 🛒<br><br><a href="/shop" style="color:#667eea;">Ir a la tienda</a></p>
        @endif
    </div>

    <style>
        .item { display: flex; justify-content: space-between; align-items: center; padding: 16px; border-bottom: 1px solid #eee; }
        .item-info h3 { color: #333; font-size: 16px; }
        .item-info span { color: #888; font-size: 13px; }
        .cantidad { display: flex; align-items: center; gap: 10px; margin-top: 8px; }
        .btn-cant { background: #667eea; color: white; border: none; width: 28px; height: 28px; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .btn-cant:hover { background: #556cd6; }
        .cant-num { font-weight: bold; color: #333; min-width: 20px; text-align: center; }
        .item-right { display: flex; align-items: center; gap: 16px; }
        .subtotal { font-weight: bold; color: #667eea; }
        .btn-remove { background: #f44336; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; }
        .total { text-align: right; font-size: 24px; font-weight: bold; color: #333; margin-top: 24px; }
        .acciones { display: flex; justify-content: space-between; margin-top: 24px; }
        .acciones a, .btn-comprar { padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; border: none; cursor: pointer; }
        .seguir { background: #eee; color: #666; }
        .btn-comprar { background: #4caf50; color: white; }
    </style>
@endsection