<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang; // Import model Keranjang

class PembayaranController extends Controller
{
    // Menampilkan halaman form pembayaran
    public function create()
    {
        // Ambil semua item yang ada di keranjang
        $keranjang = Keranjang::with('produk')->get();

        // Jika keranjang kosong, redirect ke halaman produk
        if ($keranjang->isEmpty()) {
            return redirect()->route('produk.index')->with('error', 'Keranjang kosong! Silakan pilih produk terlebih dahulu.');
        }

        return view('admin.pembayaran.create', compact('keranjang'));
    }
}


