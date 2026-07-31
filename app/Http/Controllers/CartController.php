<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
        public function add(Request $request, $id)
        
        {
            $product = Product::findOrFail($id);

            $cart = session()->get('cart', []);

            $cantidadEnCarrito = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

            if ($cantidadEnCarrito + 1 > $product->stock) {
                return redirect('/shop')->with('error', 'No hay más stock disponible de ' . $product->name);
            }

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }

    session()->put('cart', $cart);

    return redirect('/shop');
}

        public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', ['cart' => $cart, 'total' => $total]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect('/cart');
    }

    public function increase($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }

    return redirect('/cart');
}

public function decrease($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
    }

    return redirect('/cart');
}

public function checkout()
{
    $cart = session()->get('cart', []);

    if (count($cart) === 0) {
        return redirect('/shop');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $order = \App\Models\Order::create([
        'user_id' => auth()->id(),
        'total' => $total,
        'status' => 'pendiente',
    ]);

    foreach ($cart as $id => $item) {
        $order->items()->create([
            'product_id' => $id,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);

        $product = \App\Models\Product::find($id);
        $product->stock -= $item['quantity'];
        $product->save();
    }

    session()->forget('cart');

    return redirect('/orders')->with('success', '¡Compra realizada con éxito!');
}

}