<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function tambah(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk_kode' => 'required|exists:produk,kode_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Gantilah kode pelanggan sesuai logika aplikasimu
        // Jika sudah ada login pelanggan, bisa pakai: auth()->user()->kode_pelanggan
        $kodePelanggan = 'KODE001'; // Contoh hardcoded

        // Cek apakah produk sudah ada di keranjang untuk pelanggan ini
        $item = Keranjang::where('produk_kode', $request->produk_kode)
                         ->where('kode_pelanggan', $kodePelanggan)
                         ->first();

        if ($item) {
            // Jika produk sudah ada, tambah jumlahnya
            $item->jumlah += $request->jumlah;
            $item->save();
        } else {
            // Jika belum, buat item baru
            Keranjang::create([
                'produk_kode'    => $request->produk_kode,
                'jumlah'         => $request->jumlah,
                'kode_pelanggan' => $kodePelanggan,
            ]);
        }

        return redirect()->route('admin.keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function index()
    {
        // Gantilah dengan kode pelanggan dinamis jika perlu
        $kodePelanggan = 'KODE001';

        // Ambil keranjang milik pelanggan
        $keranjang = Keranjang::with('produk')
                              ->where('kode_pelanggan', $kodePelanggan)
                              ->get();

        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function destroy($id)
    {
        Keranjang::destroy($id);
        return back()->with('success', 'Item keranjang dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return redirect()->route('admin.keranjang.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }
    
}
