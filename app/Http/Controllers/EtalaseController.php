<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class EtalaseController extends Controller
{
    /**
     * Tampilkan semua produk di halaman etalase
     */
    public function index()
    {
        // Ambil semua produk yang statusnya tersedia
        $produk = Produk::where('status', '!=', 'habis')->get();

        return view('etalase.index', compact('produk'));
    }

    /**
     * Tampilkan detail produk berdasarkan ID
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        return view('etalase.show', compact('produk'));
    }
}
