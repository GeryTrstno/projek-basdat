<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->get();

        return view('cart', [
            'title' => 'Cart',
            'carts' => $carts
        ]);
    }


    // Tambah ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        Cart::updateOrCreate(
            [
                'product_id' => $request->product_id
            ],
            [
                'quantity' => \DB::raw('quantity + 1')
            ]
        );

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

}
