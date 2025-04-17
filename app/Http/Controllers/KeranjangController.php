<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Keranjang::with('produk')->get();
        return view('admin.keranjang.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_kode' => 'required|exists:produk,kode_produk',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $produk = Produk::where('kode_produk', $request->produk_kode)->first();

        // Cek apakah produk bisa ditambahkan ke keranjang
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Jika stok cukup atau status produk = 'Pesan', maka lanjut
        if ($produk->stok >= $request->jumlah || $produk->status === 'Pesan') {
            $item = Keranjang::where('produk_kode', $request->produk_kode)->first();

            if ($item) {
                $item->jumlah += $request->jumlah;
                $item->save();
            } else {
                Keranjang::create([
                    'produk_kode' => $request->produk_kode,
                    'jumlah' => $request->jumlah,
                ]);
            }

            return redirect()->route('keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
        }

        return redirect()->back()->with('error', 'Stok produk tidak mencukupi dan tidak dapat dipesan.');
    }

        public function update(Request $request, $id)
    {
        $item = Keranjang::findOrFail($id); // Temukan item berdasarkan ID

        // Validasi input
        $request->validate([
            'jumlah' => 'required|numeric|min:1', // Pastikan jumlahnya valid
        ]);

        // Update jumlah item di keranjang
        $item->jumlah = $request->jumlah;
        $item->save();

        // Kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $item = Keranjang::findOrFail($id);
        $item->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item keranjang dihapus.');
    }
}
