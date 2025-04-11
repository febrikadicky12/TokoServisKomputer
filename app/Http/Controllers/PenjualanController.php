<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class PenjualanController extends Controller
{
    /**
     * Tampilkan semua produk di halaman penjualan
     */
    public function index()
    {
        // Ambil semua produk yang tidak habis
        $produk = Produk::where('status', '!=', 'habis')->get();

        return view('admin.penjualan.index', compact('produk'));
    }

    /**
     * Tampilkan detail produk berdasarkan ID
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->status === 'habis') {
            return redirect()->route('penjualan.index')->with('error', 'Produk tidak tersedia.');
        }

        return view('admin.penjualan.show', compact('produk'));
    }
}
