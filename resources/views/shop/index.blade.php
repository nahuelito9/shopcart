@extends('layouts.app')

@section('title', 'Tienda')

@section('content')
    <h1 style="color:#333; margin-bottom:24px;">🛍️ Nuestra Tienda</h1>

    <div class="grid">
        @foreach ($products as $product)
            <div class="card">
                <div class="card-img">📦</div>
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <p class="desc">{{ $product->description }}</p>
                    <div class="precio">${{ number_format($product->price, 2) }}</div>
                    <div class="stock">{{ $product->stock }} disponibles</div>
                    <form action="/cart/add/{{ $product->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-add">🛒 Agregar al carrito</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; }
        .card { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden; display: flex; flex-direction: column; }
        .card-img { height: 140px; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; font-size: 48px; }
        .card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
        .card-body h3 { color: #333; margin-bottom: 8px; font-size: 17px; }
        .card-body .desc { color: #888; font-size: 13px; margin-bottom: 12px; flex: 1; }
        .precio { font-size: 22px; font-weight: bold; color: #667eea; margin-bottom: 4px; }
        .stock { font-size: 12px; color: #4caf50; margin-bottom: 14px; }
        .btn-add { background: #4caf50; color: white; border: none; padding: 10px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; }
        .btn-add:hover { background: #43a047; }
    </style>
@endsection