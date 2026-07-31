<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();

    $stats = [
        'total_productos' => Product::count(),
        'sin_stock' => Product::where('stock', 0)->count(),
        'total_ordenes' => \App\Models\Order::count(),
        'ingresos' => \App\Models\Order::sum('total'),
    ];

    return view('admin.products.index', ['products' => $products, 'stats' => $stats]);
}

    public function create()
{
    return view('admin.products.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    Product::create($request->all());

    return redirect('/admin/products');
}


public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.products.edit', ['product' => $product]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    $product = Product::findOrFail($id);
    $product->update($request->all());

    return redirect('/admin/products');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect('/admin/products');
}

public function orders()
{
    $orders = \App\Models\Order::with('user', 'items.product')->latest()->get();
    return view('admin.orders', ['orders' => $orders]);
}

}