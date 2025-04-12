<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $products = Product::latest();

    if (request('search')) {
        $products->where('name', 'like', '%' . request('search') . '%');
    }
    return view('home', ['title' => 'Home', 'products' => $products->get()]);
});

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/login-user', function () {
    return view('login-user', ['title' => 'Login']);
});

Route::get('/{slug}', function ($slug) {
    $product = Product::with('category', 'seller')->where('slug', $slug)->firstOrFail();
    return view('product', ['title' => 'Product', 'product' => $product]);
});

