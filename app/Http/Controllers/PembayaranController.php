<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Pembayaran;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\DetailPembayaran;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function create()
    {
        $keranjang = Keranjang::with('produk')->get();
        
        if ($keranjang->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong!');
        }
        
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item->produk->harga * $item->jumlah;
        }
        
        return view('admin.pembayaran.create', compact('keranjang', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'metode_pembayaran' => 'required',
            // tambahkan validasi lain yang diperlukan
        ]);

        // Mulai transaksi database
        DB::beginTransaction();
        
        try {
            $keranjang = Keranjang::with('produk')->get();
            
            if ($keranjang->isEmpty()) {
                return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong!');
            }
            
            $total = 0;
            foreach ($keranjang as $item) {
                $total += $item->produk->harga * $item->jumlah;
            }
            
            // Buat record pembayaran
            $pembayaran = Pembayaran::create([
                'nomor_pembayaran' => 'TRX-' . time(),
                'nama_pelanggan' => $request->nama_pelanggan,
                'total_bayar' => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'Selesai',
                // tambahkan field lain yang diperlukan
            ]);
            
            // Simpan detail pembayaran dan kurangi stok
            foreach ($keranjang as $item) {
                // Simpan detail
                DetailPembayaran::create([
                    'pembayaran_id' => $pembayaran->id,
                    'produk_kode' => $item->produk_kode,
                    'jumlah' => $item->jumlah,
                    'harga' => $item->produk->harga,
                    'subtotal' => $item->produk->harga * $item->jumlah
                ]);
                
                // Kurangi stok produk
                $item->produk->kurangiStok($item->jumlah);
            }
            
            // Kosongkan keranjang
            Keranjang::truncate();
            
            // Commit transaksi
            DB::commit();
            
            return redirect()->route('pembayaran.show', $pembayaran->id)->with('success', 'Pembayaran berhasil!');
            
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cancel($id)
    {
        // Mulai transaksi database
        DB::beginTransaction();
        
        try {
            $pembayaran = Pembayaran::with('details.produk')->findOrFail($id);
            
            if ($pembayaran->status === 'Dibatalkan') {
                return redirect()->back()->with('error', 'Pembayaran sudah dibatalkan sebelumnya!');
            }
            
            // Kembalikan stok untuk setiap produk
            foreach ($pembayaran->details as $detail) {
                $produk = Produk::where('kode_produk', $detail->produk_kode)->first();
                if ($produk) {
                    $produk->tambahStok($detail->jumlah);
                }
            }
            
            // Update status pembayaran
            $pembayaran->status = 'Dibatalkan';
            $pembayaran->save();
            
            // Commit transaksi
            DB::commit();
            
            return redirect()->back()->with('success', 'Pembayaran berhasil dibatalkan dan stok dikembalikan.');
            
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('details.produk')->findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }
}
=======
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

<<<<<<< HEAD
}
=======
}
>>>>>>> origin/main
>>>>>>> b6b512ad74b66d62be4208c3ccd1642861a93c56
