<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {

    $products = Product::latest();

    if (request('search')) {
        $products->where('name', 'like', '%' . request('search') . '%');
    }

    return view('home', ['title' => 'Home', 'products' => $products->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{id}/increment', [CartController::class, 'increment'])->name('cart.increment');
    Route::patch('/cart/{id}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

    Route::get('/create', function () {
       return view('create', ['title' => 'Buat Produk', 'categories' => Category::all()]);
    });

    Route::get('/my-products', [ProductController::class, 'myProducts'])->name('products.my');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

});


require __DIR__.'/auth.php';

Route::get('/{slug}', function ($slug) {
    $product = Product::with('category', 'seller')->where('slug', $slug)->firstOrFail();
    return view('product', ['title' => 'Product', 'product' => $product]);
})->middleware(['auth', 'verified']);
