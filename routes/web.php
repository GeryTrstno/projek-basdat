<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $products = Product::latest();

    if (request('search')) {
        $products->where('name', 'like', '%' . request('search') . '%');
    }
    return view('home', ['title' => 'Home', 'products' => $products->get()]);
});

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::resource('products', ProductController::class);

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('/cart/{id}/increment', [CartController::class, 'increment'])->name('cart.increment');
Route::patch('/cart/{id}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

Route::get('/shop', function () {
    return view('shop', ['title' => 'Create Product', 'categories' => Category::all()]);
});

Route::get('/edit', function () {
    return view('edit', ['title' => 'Edit Product']);
});

Route::get('/login-user', function () {
    return view('login-user', ['title' => 'Login']);
});

Route::get('/{slug}', function ($slug) {
    $product = Product::with('category', 'seller')->where('slug', $slug)->firstOrFail();
    return view('product', ['title' => 'Product', 'product' => $product]);
});

