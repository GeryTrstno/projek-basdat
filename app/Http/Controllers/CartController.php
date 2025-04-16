<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

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

        $userId = Auth::id();

        // Cek apakah produk sudah ada di cart user ini
        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }


    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }


    public function increment($id)
    {
        $cart = Cart::with('product')->findOrFail($id);

        // Cek apakah jumlah di cart sudah sama dengan stok produk
        if ($cart->quantity < $cart->product->amount) {
            $cart->increment('quantity');
            return back()->with('success', 'Jumlah produk berhasil ditambah.');
        }

        return back()->with('error', 'Jumlah produk sudah mencapai batas stok!');
    }


    public function decrement($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
        } else {
            $cart->delete();
        }

        return back();
    }

}
