<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('beranda');
});

// Produk
Route::resource('/products', ProductController::class);

// Pesanan
Route::resource('/pesanan', PesananController::class);



// Autentikasi
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Halaman tambahan
Route::get('/beranda', [ProductController::class, 'beranda']);
Route::get('/menuproduk', [ProductController::class, 'menuproduk']);
Route::get('/kontak', [ProductController::class, 'kontak']);

// Custom tambahan jika butuh tampilan khusus
Route::get('/form', [PesananController::class, 'showForm'])->name('form');
Route::get('/hasil', [PesananController::class, 'showHasil'])->name('hasil');

Route::get('/riwayat-pesanan', [PesananController::class, 'riwayatAdmin'])->name('riwayat.pesanan');

// Route hapus pesanan di riwayat
Route::delete('/riwayat-pesanan/{id}', [PesananController::class, 'destroy'])->name('riwayat.pesanan.destroy');

//Route untuk keranjang
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/users-import', [UserController::class, 'import']);
Route::get('/users-export', [UserController::class, 'export']);