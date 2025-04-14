<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Route dummy bisa dihapus karena sudah ada controller-nya
// Route::get('/admin/servis', function () {
//     return 'Halaman Servis';
// })->name('servis.index');

// Route::get('/admin/penjualan', function () {
// })->name('penjualan.index');

Route::prefix('admin')->group(function () {

    // ====== SERVIS ======
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::get('/servis/create', [ServisController::class, 'create'])->name('servis.create');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/servis/{id}', [ServisController::class, 'show'])->name('servis.show'); // ⬅ Tambahan
    Route::get('/servis/{id}/edit', [ServisController::class, 'edit'])->name('servis.edit');
    Route::put('/servis/{id}', [ServisController::class, 'update'])->name('servis.update');
    Route::delete('/servis/{id}', [ServisController::class, 'destroy'])->name('servis.destroy');
    


    // ====== PRODUK ======
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // ====== Keranjang ======
    Route::get('admin/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('admin/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('admin/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::put('admin/keranjang/{id}/update', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::resource('admin/keranjang', KeranjangController::class)->except(['update']);

    
    Route::get('admin/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
});