<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\NotaPembayaranController;
use App\Http\Controllers\RiwayatController;

// ====== DASHBOARD ======
Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// ====== ADMIN GROUP ======
Route::prefix('admin')->name('admin.')->group(function () {

    // ====== SERVIS ======
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::get('/servis/create', [ServisController::class, 'create'])->name('servis.create');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');
<<<<<<< HEAD
    Route::get('/servis/{id}', [ServisController::class, 'show'])->name('servis.show'); // ⬅ createan
=======
    Route::get('/servis/{kode_notaservis}/cetak', [ServisController::class, 'cetak'])->name('servis.cetak');
    Route::get('/servis/{id}', [ServisController::class, 'show'])->name('servis.show');
>>>>>>> origin/main
    Route::get('/servis/{id}/edit', [ServisController::class, 'edit'])->name('servis.edit');
    Route::put('/servis/{id}', [ServisController::class, 'update'])->name('servis.update');
    Route::delete('/servis/{id}', [ServisController::class, 'destroy'])->name('servis.destroy');
   


    // ====== PRODUK ======
    // ✅ perbaikan
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

<<<<<<< HEAD
    // ====== Keranjang ======
    Route::get('admin/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('admin/keranjang/create', [KeranjangController::class, 'create'])->name('keranjang.create');
    Route::delete('admin/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::put('admin/keranjang/{id}/update', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::resource('admin/keranjang', KeranjangController::class)->except(['update']);
    Route::post('/keranjang/{id}/konfirmasi', [KeranjangController::class, 'konfirmasi'])->name('keranjang.konfirmasi');
    Route::post('/keranjang/{id}/batalkan', [KeranjangController::class, 'batalkan'])->name('keranjang.batalkan');

    // Route untuk keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');    
    Route::put('keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::post('keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');
    
    // Route untuk pembayaran
    Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('pembayaran/{id}/cancel', [PembayaranController::class, 'cancel'])->name('pembayaran.cancel');
=======
    // ====== KERANJANG ======
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/{id}/update', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    // ====== PEMBAYARAN ======
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', [PembayaranController::class, 'create'])->name('create');
        Route::post('/', [PembayaranController::class, 'store'])->name('store');
    });

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
        Route::get('/{id}', [RiwayatController::class, 'show'])->name('show');
    });
});
>>>>>>> origin/main

    Route::get('/admin/riwayat', function () {
        return view('admin.riwayat.index');
    })->name('riwayat.index');

<<<<<<< HEAD
    Route::get('/admin/riwayat/pemesanan', function () {
        return view('admin.riwayat.pemesanan');
    })->name('riwayat.pemesanan');

    Route::get('/admin/riwayat/transaksi', function () {
        return view('admin.riwayat.transaksi');
    })->name('riwayat.transaksi');

    });
=======
// ====== NOTA PEMBAYARAN (PUBLIC) ======
Route::post('/pembayaran', [NotaPembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/nota-pembayaran-preview', [NotaPembayaranController::class, 'preview'])->name('nota.preview');
Route::get('/nota-pembayaran/{kode_notapembayaran}', [NotaPembayaranController::class, 'show'])->name('nota.show');
Route::get('/nota-pembayaran/cetak/{kode_notapembayaran}', [NotaPembayaranController::class, 'cetak'])->name('nota.cetak');
>>>>>>> origin/main
