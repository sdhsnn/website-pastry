<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Product;


class PesananController extends Controller
{
    public function showForm(Request $request)
{
    $products = Product::all();
    $selectedProductId = $request->query('product_id'); // Ambil product_id dari URL query string

    return view('pesanan.form', compact('products', 'selectedProductId'));
}


    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|max:255',
        'alamat' => 'required',
        'no_hp' => 'required|regex:/^08[0-9]{8,13}$/',
        'produk' => 'required',
        'jumlah' => 'required|numeric|min:1',
    ]);

    $produk = Product::find($request->produk);

    if (!$produk) {
        return redirect()->back()->withErrors(['produk' => 'Produk tidak ditemukan'])->withInput();
    }

    // Cek stok
    if ($produk->stock < $request->jumlah) {
        return redirect()->back()
            ->withErrors(['jumlah' => 'Stok produk tidak cukup. Stok tersedia: ' . $produk->stock])
            ->withInput();
    }

    // Simpan pesanan
    Pesanan::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'produk' => $produk->title,
        'jumlah' => $request->jumlah,
    ]);

    // Kurangi stok produk
    $produk->stock -= $request->jumlah;
    $produk->save();

    return redirect()->route('hasil')->with('success', 'Pesanan berhasil disimpan!');
}


    public function showHasil()
    {
        // Ambil pesanan terakhir dari database
        $pesanan = Pesanan::latest()->first();

        return view('pesanan.hasil', compact('pesanan'));
    }

    public function riwayatAdmin()
    {
        $pesanans = Pesanan::latest()->paginate(20);
        return view('pesanan.riwayat', compact('pesanans'));
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('riwayat.pesanan')->with('success', 'Pesanan berhasil dihapus!');

    }
}
