<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\NotaPembayaran;
use App\Models\Pelanggan;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /**
     * Tampilkan halaman form pembayaran.
     */
    public function create()
    {
        // Ambil kode_pelanggan dari user yang sedang login atau sesuai parameter
        // Misalnya $kodePelanggan datang dari sesi atau request
        $kodePelanggan = $request->kode_pelanggan ?? session('kode_pelanggan');
        // Contoh, pastikan ini sesuai dengan logika aplikasi Anda
        
        // Ambil data keranjang untuk kode_pelanggan
        $keranjang = Keranjang::with('produk')->where('kode_pelanggan', $kodePelanggan)->get();

        // Cek jika keranjang kosong
        if ($keranjang->isEmpty()) {
            return redirect()->route('admin.produk.index')
                ->with('error', 'Keranjang kosong! Silakan pilih produk terlebih dahulu.');
        }

        // Kirim data keranjang ke view
        return view('admin.pembayaran.index', compact('keranjang', 'kodePelanggan'));
    }

    /**
     * Proses penyimpanan pembayaran.
     */
    public function store(Request $request)
    {
        // Validasi input total pembayaran
        $request->validate([
            'total' => 'required|numeric',
            'kode_pelanggan' => 'required|string',
            'kode_pelanggan' => 'KODE001', 
        ]);

        $kodePelanggan = $request->kode_pelanggan;

        // Simpan nota pembayaran
        $nota = new NotaPembayaran();
        $nota->kode_notapembayaran = 'NP-' . strtoupper(uniqid()); // Buat kode nota secara otomatis
        $nota->tanggal = now(); // Simpan tanggal transaksi
        $nota->total_pembayaran = $request->total; // Total pembayaran
        $nota->save();

        // Simpan detail produk yang dibeli ke nota pembayaran
        $keranjang = Keranjang::where('kode_pelanggan', $kodePelanggan)->get(); 
        foreach ($keranjang as $item) {
            $nota->produks()->attach($item->produk_id, [
                'kuantitas' => $item->jumlah,
                'total_harga' => $item->produk->harga * $item->jumlah,
            ]);
        }

        // Hapus keranjang setelah pembayaran
        Keranjang::where('kode_pelanggan', $kodePelanggan)->delete();

        // Redirect ke halaman nota pembayaran
        return redirect()->route('notapembayaran.nota', ['kode_notapembayaran' => $nota->kode_notapembayaran]);
    }

    public function show($kode_notapembayaran)
{
    $nota = NotaPembayaran::with('produks')->where('kode_notapembayaran', $kode_notapembayaran)->first();

    if (!$nota) {
        return redirect()->back()->with('error', 'Nota tidak ditemukan.');
    }

    return view('admin.pembayaran.show', compact('nota'));
}

}