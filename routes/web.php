<?php

use App\Http\Controllers\SearchController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Dashboard', 'products' => Product::all()]);
});

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/{slug}', function ($slug) {
    $product = Product::with('category', 'seller')->where('slug', $slug)->firstOrFail();
    return view('product', ['title' => $product->name, 'product' => $product]);
});
