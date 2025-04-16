<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('produk')->get();
        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'produk_kode' => 'required|exists:produk,kode_produk',
            'jumlah' => 'required|numeric|min:1'
        ]);

        $produk = Produk::where('kode_produk', $request->produk_kode)->first();
        
        // Cek stok tersedia
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $produk->stok);
        }

        // Cek jika produk sudah ada di keranjang
        $keranjang = Keranjang::where('produk_kode', $request->produk_kode)->first();
        
        if ($keranjang) {
            // Update jumlah jika produk sudah ada
            if ($produk->stok < ($keranjang->jumlah + $request->jumlah)) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $produk->stok);
            }
            
            $keranjang->jumlah += $request->jumlah;
            $keranjang->save();
        } else {
            // Tambah produk baru ke keranjang
            Keranjang::create([
                'produk_kode' => $request->produk_kode,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $produk = $keranjang->produk;

        // Cek stok tersedia
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $produk->stok);
        }

        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        Keranjang::truncate();
        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}