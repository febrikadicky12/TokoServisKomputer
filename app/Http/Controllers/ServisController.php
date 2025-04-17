<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ServisController extends Controller
{
    public function index()
    {
        $servis = DB::table('nota_servis')
            ->join('pelanggan', 'nota_servis.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
            ->select(
                'nota_servis.*',
                'pelanggan.nama as nama_pelanggan',
                'pelanggan.no_telp'
            )
            ->get();

        return view('admin.servis.index', compact('servis'));
    }

    public function create()
    {
        return view('admin.servis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_pelanggan' => 'required|string|max:255',
            'no_telp' => 'required|string|regex:/^[0-9]{10,12}$/',
            'deskripsi' => 'required|string',
        ]);

        // Cari pelanggan berdasarkan nama & no_telp
        $pelanggan = DB::table('pelanggan')
            ->where('nama', $request->nama_pelanggan)
            ->where('no_telp', $request->no_telp)
            ->first();

        if (!$pelanggan) {
            $lastId = DB::table('pelanggan')->max('id') ?? 0;
            $kodePelanggan = 'PLG' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

            DB::table('pelanggan')->insert([
                'kode_pelanggan' => $kodePelanggan,
                'nama' => $request->nama_pelanggan,
                'no_telp' => $request->no_telp,
            ]);
        } else {
            $kodePelanggan = $pelanggan->kode_pelanggan;
        }

        // Generate kode_notaservis baru
        $lastKode = DB::table('nota_servis')->orderByDesc('kode_notaservis')->value('kode_notaservis');
        $urutan = $lastKode ? intval(substr($lastKode, 2)) + 1 : 1;
        $kodeNotaServis = 'NS' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        DB::table('nota_servis')->insert([
            'kode_notaservis' => $kodeNotaServis,
            'tanggal' => $request->tanggal,
            'kode_pelanggan' => $kodePelanggan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.servis.index')->with('success', 'Data servis berhasil ditambahkan');
    }

    public function edit($id)
    {
        $servis = DB::table('nota_servis')
            ->join('pelanggan', 'nota_servis.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
            ->where('kode_notaservis', $id)
            ->select(
                'nota_servis.*',
                'pelanggan.nama as nama_pelanggan',
                'pelanggan.no_telp'
            )
            ->first();

        if (!$servis) {
            return redirect()->route('servis.index')->with('error', 'Data servis tidak ditemukan');
        }

        return view('admin.servis.edit', compact('servis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_pelanggan' => 'required|string|max:255',
            'no_telp' => 'required|string|regex:/^[0-9]{10,12}$/',
            'deskripsi' => 'required|string',
        ]);

        // Cek pelanggan lama/baru
        $pelanggan = DB::table('pelanggan')
            ->where('nama', $request->nama_pelanggan)
            ->where('no_telp', $request->no_telp)
            ->first();

        if (!$pelanggan) {
            $lastId = DB::table('pelanggan')->max('id') ?? 0;
            $kodePelanggan = 'PLG' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

            DB::table('pelanggan')->insert([
                'kode_pelanggan' => $kodePelanggan,
                'nama' => $request->nama_pelanggan,
                'no_telp' => $request->no_telp,
            ]);
        } else {
            $kodePelanggan = $pelanggan->kode_pelanggan;
        }

        DB::table('nota_servis')->where('kode_notaservis', $id)->update([
            'tanggal' => $request->tanggal,
            'kode_pelanggan' => $kodePelanggan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('servis.index')->with('success', 'Data servis berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::table('nota_servis')->where('kode_notaservis', $id)->delete();
        return redirect()->route('servis.index')->with('success', 'Data servis berhasil dihapus');
    }

    public function show($id)
    {
        $servis = DB::table('nota_servis')
            ->join('pelanggan', 'nota_servis.kode_pelanggan', '=', 'pelanggan.id')
            ->where('kode_notaservis', $id)
            ->select(
                'nota_servis.*',
                'pelanggan.nama as nama_pelanggan',
                'pelanggan.no_telp'
            )
            ->first();

        if (!$servis) {
            return redirect()->route('servis.index')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.servis.show', compact('servis'));
    }
    public function cetak($kode_notaservis)
{
    // Ambil data servis
    $servis = DB::table('nota_servis')
        ->join('pelanggan', 'nota_servis.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
        ->where('nota_servis.kode_notaservis', $kode_notaservis)
        ->select('nota_servis.*', 'pelanggan.nama as nama_pelanggan', 'pelanggan.no_telp')
        ->first();

    // Load view dan generate PDF
    $pdf = PDF::loadView('admin.servis.nota', compact('servis'));

    // Return PDF sebagai download
    return $pdf->stream('nota_servis_'.$kode_notaservis.'.pdf');
}

}
