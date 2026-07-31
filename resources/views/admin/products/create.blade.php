<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Nuevo Producto</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f4f6fb; padding: 40px; }
        .container { max-width: 500px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 32px; }
        h1 { color: #333; margin-bottom: 24px; }
        label { display: block; margin-bottom: 6px; color: #555; font-weight: bold; font-size: 14px; }
        input, textarea { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; margin-bottom: 18px; font-family: inherit; }
        input:focus, textarea:focus { outline: none; border-color: #667eea; }
        .btn { background: #667eea; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 15px; }
        .volver { display: inline-block; margin-top: 16px; color: #667eea; text-decoration: none; }
        .error { color: #f44336; font-size: 13px; margin-top: -12px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Nuevo Producto</h1>

        <form action="/admin/products" method="POST">
            @csrf

            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label>Descripción</label>
            <textarea name="description" rows="3">{{ old('description') }}</textarea>

            <label>Precio</label>
            <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
            @error('price') <div class="error">{{ $message }}</div> @enderror

            <label>Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}" required>
            @error('stock') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn">Guardar producto</button>
        </form>

        <a href="/admin/products" class="volver">← Volver a productos</a>
    </div>
</body>
</html>