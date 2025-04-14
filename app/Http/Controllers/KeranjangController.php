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

        // Cek apakah produk sudah ada di keranjang
        $item = Keranjang::where('produk_kode', $request->produk_kode)->first();

        if ($item) {
            // Jika produk sudah ada, tambah jumlahnya
            $item->jumlah += $request->jumlah;
            $item->save();
        } else {
            // Jika produk belum ada, buat item baru di keranjang
            Keranjang::create([
                'produk_kode' => $request->produk_kode,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function index()
    {
        // Mengambil data keranjang beserta informasi produk terkait
        $keranjang = Keranjang::with('produk')->get();
        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function destroy($id)
    {
        // Hapus item keranjang berdasarkan ID
        Keranjang::destroy($id);
        return back()->with('success', 'Item keranjang dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input untuk jumlah
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Temukan item keranjang berdasarkan ID dan update jumlahnya
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }
}
