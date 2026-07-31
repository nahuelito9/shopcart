@extends('layouts.app')

@section('title', 'Admin - Productos')

@section('content')
    <h1 style="color:#333; margin-bottom:24px;">📦 Panel de Administración</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-num">{{ $stats['total_productos'] }}</div>
            <div class="stat-label">Productos</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:#f44336;">{{ $stats['sin_stock'] }}</div>
            <div class="stat-label">Sin stock</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:#667eea;">{{ $stats['total_ordenes'] }}</div>
            <div class="stat-label">Órdenes</div>
        </div>
        <div class="stat-card">
            <div class="stat-num" style="color:#4caf50;">${{ number_format($stats['ingresos'], 2) }}</div>
            <div class="stat-label">Ingresos</div>
        </div>
    </div>

    <div style="background:white; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:32px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
            <h2 style="color:#333;">Productos</h2>
            <div>
                <a href="/admin/orders" style="background:#eee; color:#666; padding:10px 18px; border-radius:8px; text-decoration:none; font-weight:bold; margin-right:8px;">📋 Ver órdenes</a>
                <a href="/admin/products/create" style="background:#667eea; color:white; padding:10px 18px; border-radius:8px; text-decoration:none; font-weight:bold;">➕ Nuevo producto</a>
            </div>
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #eee; color:#888; font-size:13px; text-transform:uppercase;">Nombre</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #eee; color:#888; font-size:13px; text-transform:uppercase;">Precio</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #eee; color:#888; font-size:13px; text-transform:uppercase;">Stock</th>
                    <th style="text-align:left; padding:12px; border-bottom:1px solid #eee; color:#888; font-size:13px; text-transform:uppercase;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td style="padding:12px; border-bottom:1px solid #eee;">{{ $product->name }}</td>
                        <td style="padding:12px; border-bottom:1px solid #eee; font-weight:bold;">${{ number_format($product->price, 2) }}</td>
                        <td style="padding:12px; border-bottom:1px solid #eee; color:{{ $product->stock < 10 ? '#f44336' : '#4caf50' }};">{{ $product->stock }} unidades</td>
                        <td style="padding:12px; border-bottom:1px solid #eee;">
                            <a href="/admin/products/{{ $product->id }}/edit" style="color:#667eea; text-decoration:none;">✏️ Editar</a>
                            <form action="/admin/products/{{ $product->id }}" method="POST" style="display:inline; margin-left:8px;">
                                @csrf @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:#f44336; cursor:pointer;">🗑️ Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
        .stat-card { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 24px; text-align: center; }
        .stat-num { font-size: 32px; font-weight: bold; color: #333; }
        .stat-label { color: #888; font-size: 13px; text-transform: uppercase; margin-top: 6px; }
    </style>
@endsection