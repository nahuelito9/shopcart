<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/products', [ProductController::class, 'index']);
    Route::get('/admin/products/create', [ProductController::class, 'create']);
    Route::post('/admin/products', [ProductController::class, 'store']);
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/admin/products/{id}', [ProductController::class, 'update']);
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);
    Route::get('/admin/orders', [ProductController::class, 'orders']);

});

Route::middleware('auth')->group(function () {
    Route::post('/checkout', [CartController::class, 'checkout']);
    Route::get('/orders', [OrderController::class, 'index']);
});

Route::get('/shop', [ShopController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);

Route::get('/cart', [CartController::class, 'index']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);

Route::patch('/cart/increase/{id}', [CartController::class, 'increase']);
Route::patch('/cart/decrease/{id}', [CartController::class, 'decrease']);

require __DIR__.'/settings.php';
