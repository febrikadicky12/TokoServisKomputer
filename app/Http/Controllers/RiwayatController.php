<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaPembayaran;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil semua data nota pembayaran, bisa juga filter berdasarkan user jika perlu
        $riwayat = NotaPembayaran::orderBy('tanggal', 'desc')->get();

        return view('admin.riwayat.index', compact('riwayat'));
    }

    public function show($id)
    {
        // Ambil detail nota berdasarkan ID
        $nota = NotaPembayaran::findOrFail($id);

        return view('admin.riwayat.show', compact('nota'));
    }
}
