<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function tambah(Request $request)
    {
        $request->validate([
            'produk_kode' => 'required|exists:produk,kode_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cari apakah produk sudah ada di keranjang
        $item = Keranjang::where('produk_kode', $request->produk_kode)->first();

        // Jika ada, update jumlahnya
        if ($item) {
            $item->jumlah += $request->jumlah;
            $item->save();
        } else {
            // Jika belum ada, tambah item baru
            Keranjang::create([
                'produk_kode' => $request->produk_kode,
                'jumlah' => $request->jumlah,
            ]);
        }

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->route('keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function index()
    {
        $keranjang = Keranjang::with('produk')->get(); // Ambil semua item keranjang beserta relasi produk
        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function destroy($id)
    {
        // Menghapus item dari keranjang
        Keranjang::destroy($id);
        return back()->with('success', 'Item keranjang dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input jumlah
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cari item keranjang berdasarkan ID
        $keranjang = Keranjang::findOrFail($id);

        // Update jumlah produk
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }
}
