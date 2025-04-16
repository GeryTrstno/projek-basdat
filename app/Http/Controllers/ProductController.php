<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        if (request('search')) {
            $products = Product::where('name', 'like', '%' . request('search') . '%')->get();
        }

        return view('products.index', [
            'title' => 'Daftar Produk',
            'products' => $products,
        ]);
    }

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

        return redirect()->route('products.my')->with('success', 'Produk Berhasil Ditambahkan !');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        // Cek apakah user pemilik produk
        if ($product->seller_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('products.edit', [
            'title' => 'Edit Produk',
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = [
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'slug' => Str::slug($validated['name']) . '-' . uniqid(),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.my')->with('success', 'Produk Berhasil Diperbarui!');
    }


    public function myProducts()
    {
        $products = Product::where('seller_id', Auth::id())->latest()->get();

        return view('my-products', [
            'title' => 'Produk Saya',
            'products' => $products,
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product && $product->seller_id === Auth::id()) {
            $product->delete();
            return redirect()->route('products.my')->with('success', 'Produk berhasil dihapus');
        }

        return redirect()->route('products.my')->with('error', 'Produk tidak ditemukan atau Anda tidak memiliki izin untuk menghapus produk ini');
    }
}

