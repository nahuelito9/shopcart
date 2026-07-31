@extends('layouts.app')

@section('title', 'Mis Órdenes')

@section('content')
    <h1 style="color:#333; margin-bottom:24px;">📋 Mis Órdenes</h1>

    @forelse ($orders as $order)
        <div style="background:white; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:24px; margin-bottom:20px;">
            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:12px; margin-bottom:12px;">
                <span style="font-weight:bold; color:#333;">Orden #{{ $order->id }}</span>
                <span style="background:#fff3e0; color:#e65100; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:bold;">{{ $order->status }}</span>
            </div>
            @foreach ($order->items as $item)
                <div style="display:flex; justify-content:space-between; padding:6px 0; color:#666; font-size:14px;">
                    <span>{{ $item->quantity }} x {{ $item->product->name }}</span>
                    <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
            @endforeach
            <div style="text-align:right; font-size:18px; font-weight:bold; color:#667eea; margin-top:12px; padding-top:12px; border-top:1px solid #eee;">Total: ${{ number_format($order->total, 2) }}</div>
        </div>
    @empty
        <div style="text-align:center; color:#888; padding:40px; background:white; border-radius:12px;">Aún no tienes compras 🛒<br><br><a href="/shop" style="color:#667eea;">Ir a la tienda</a></div>
    @endforelse
@endsection