<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('shop.index', ['products' => $products]);
    }
}