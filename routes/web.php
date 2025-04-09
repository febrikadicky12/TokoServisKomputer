<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServisController;

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/servis', function () {
    return 'Halaman Servis';
})->name('servis.index');

Route::get('/admin/penjualan', function () {
    return 'Halaman Penjualan';
})->name('penjualan.index');


Route::prefix('admin')->group(function () {
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    // Tambahan opsional:
    Route::get('/servis/create', [ServisController::class, 'create'])->name('servis.create');
    Route::get('/servis/{id}/edit', [ServisController::class, 'edit'])->name('servis.edit');
    Route::delete('/servis/{id}', [ServisController::class, 'destroy'])->name('servis.destroy');
});

use App\Http\Controllers\EtalaseController;

Route::get('/etalase', [EtalaseController::class, 'index'])->name('etalase.index');
Route::get('/etalase/{id}', [EtalaseController::class, 'show'])->name('etalase.show');


