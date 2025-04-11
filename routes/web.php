<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;

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
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

// ====== PENJUALAN (etalase) ======
Route::get('/etalase', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/etalase/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
