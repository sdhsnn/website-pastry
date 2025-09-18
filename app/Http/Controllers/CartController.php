<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = max(1, (int) $request->quantity); // minimal 1

        // Cek stok cukup
        if ($product->stock < $quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cart = session()->get('cart', []);

        // Jika produk sudah ada di cart
        if (isset($cart[$product->id])) {
            // Cek stok lagi untuk total quantity
            if ($product->stock < ($cart[$product->id]['quantity'] + $quantity)) {
                return back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        // Kurangi stok sesuai jumlah
        $product->stock -= $quantity;
        $product->save();

        session()->put('cart', $cart);
        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $qty = $cart[$id]['quantity'];

            // Tambahkan stok kembali ke database
            $product = Product::find($id);
            if ($product) {
                $product->stock += $qty;
                $product->save();
            }

            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $product->stock += $item['quantity'];
                $product->save();
            }
        }

        session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
