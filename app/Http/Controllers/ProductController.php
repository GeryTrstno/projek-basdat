<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('create', [
            'title' => 'Tambah Produk Baru',
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();
        $validated['seller_id'] = Auth::id();


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.create')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Cek apakah user pemilik produk
        if ($product->seller_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('products.edit', [
            'title' => 'Edit Produk',
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function myProducts()
    {
        $products = Product::where('seller_id', Auth::id())->latest()->get();

        return view('my-products', [
            'title' => 'Produk Saya',
            'products' => $products,
        ]);
    }


}

