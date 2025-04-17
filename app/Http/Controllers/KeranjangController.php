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
        // Validasi input
        $request->validate([
            'produk_kode' => 'required|exists:produk,kode_produk',
            'jumlah' => 'required|numeric|min:1',
        ]);

<<<<<<< HEAD
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
=======
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
>>>>>>> origin/main
    }

        public function update(Request $request, $id)
    {
<<<<<<< HEAD
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
=======
        // Gantilah dengan kode pelanggan dinamis jika perlu
        $kodePelanggan = 'KODE001';

        // Ambil keranjang milik pelanggan
        $keranjang = Keranjang::with('produk')
                              ->where('kode_pelanggan', $kodePelanggan)
                              ->get();

        return view('admin.keranjang.index', compact('keranjang'));
>>>>>>> origin/main
    }


    public function destroy($id)
    {
<<<<<<< HEAD
        $item = Keranjang::findOrFail($id);
        $item->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item keranjang dihapus.');
=======
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
>>>>>>> origin/main
    }
    
}
