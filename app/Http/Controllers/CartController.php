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

        $cart = Cart::where('product_id', $request->product_id)->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }


        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function increment($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity += 1;
        $cart->save();

        return back();
    }

    public function decrement($id)
    {
        $cart = Cart::findOrFail($id);
        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
        } else {
            // optionally delete if quantity is 1 and user taps "minus"
            $cart->delete();
        }

        return back();
    }
}
