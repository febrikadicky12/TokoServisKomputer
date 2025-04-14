<?php

namespace App\Http\Controllers;

use App\Models\NotaPembayaran;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class NotaPembayaranController extends Controller
{
    /**
     * Menyimpan nota pembayaran baru dari keranjang.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pelanggan' => 'required|exists:pelanggan,kode_pelanggan',
        ]);

        // Ambil semua item keranjang berdasarkan kode pelanggan
        $keranjangItems = Keranjang::where('kode_pelanggan', $request->kode_pelanggan)->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total pembayaran
        $totalPembayaran = 0;
        foreach ($keranjangItems as $item) {
            $produk = Produk::where('kode_produk', $item->produk_kode)->first();
            if ($produk) {
                $totalPembayaran += ($produk->harga * $item->jumlah);
            }
        }

        // Buat kode nota unik
        $kodeNota = 'NP-' . strtoupper(Str::random(12));

        // Simpan nota pembayaran
        $nota = NotaPembayaran::create([
            'kode_notapembayaran' => $kodeNota,
            'kode_pelanggan' => $request->kode_pelanggan,
            'total_pembayaran' => $totalPembayaran,
            'tanggal' => now(),
        ]);

        // (Opsional) Kosongkan keranjang setelah pembayaran
        Keranjang::where('kode_pelanggan', $request->kode_pelanggan)->delete();

        return redirect()->route('nota.preview')->with('success', 'Nota Pembayaran berhasil dibuat.');
    }

    /**
     * Menampilkan preview nota terbaru.
     */
    public function preview()
    {
        $nota = NotaPembayaran::with(['keranjang.produk', 'pelanggan'])->latest()->first();

        if (!$nota) {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak ada nota pembayaran yang tersedia.');
        }

        return view('admin.NotaPembayaran.nota', compact('nota'));
    }

    /**
     * Menampilkan detail nota berdasarkan kode.
     */
    public function show($kode_notapembayaran)
    {
        $nota = NotaPembayaran::with(['keranjang.produk', 'pelanggan'])
                    ->where('kode_notapembayaran', $kode_notapembayaran)
                    ->first();

        if (!$nota) {
            return redirect()->route('admin.dashboard')->with('error', 'Nota Pembayaran tidak ditemukan.');
        }

        return view('admin.pembayaran.show', compact('nota'));
    }

    /**
     * Menampilkan halaman pembayaran berdasarkan keranjang
     */
    public function showPembayaran(Request $request)
    {
        $kodePelanggan = session('kode_pelanggan', '');

        $keranjang = Keranjang::with('produk')->where('kode_pelanggan', $kodePelanggan)->get();

        if ($keranjang->isEmpty()) {
            return redirect()->route('admin.dashboard')->with('error', 'Keranjang kosong.');
        }

        return view('admin.pembayaran.index', compact('keranjang', 'kodePelanggan'));
    }

    public function index()
{
    $notas = NotaPembayaran::with('pelanggan', 'produk')->latest()->get();
    return view('admin.nota.index', compact('notas'));
}

}
