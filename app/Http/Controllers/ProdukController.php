<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('admin.produk.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk',
            'kategori' => 'required',
            'merek' => 'required',
            'jenis' => 'required',
            'spesifikasi' => 'required',
            'warna' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kondisi' => 'required',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public/produk', $namaGambar);
            $validated['gambar'] = 'produk/' . $namaGambar;
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    // Memperbarui data produk
// Memperbarui data produk
public function update(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    $validated = $request->validate([
        'kode_produk' => 'required|unique:produk,kode_produk,' . $id,
        'kategori' => 'required',
        'merek' => 'required',
        'jenis' => 'required',
        'spesifikasi' => 'required',
        'warna' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        'kondisi' => 'required',
        'status' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Cek jika ada gambar baru diupload
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $namaGambar = time() . '_' . $gambar->getClientOriginalName();
        $gambar->storeAs('public/produk', $namaGambar);
        $validated['gambar'] = 'produk/' . $namaGambar;
    } else {
        // jika tidak upload gambar baru, gunakan gambar lama
        $validated['gambar'] = $produk->gambar;
    }

    $produk->update($validated);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}

    // Menampilkan detail produk
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
