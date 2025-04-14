<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

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

            // Simpan ke storage/app/public/produk
            $gambar->storeAs('produk', $namaGambar, 'public');

            // Simpan path akses publik
            $validated['gambar'] = 'storage/produk/' . $namaGambar;
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

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

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar && Storage::exists(str_replace('storage/', 'public/', $produk->gambar))) {
                Storage::delete(str_replace('storage/', 'public/', $produk->gambar));
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();

            // Simpan ke storage/app/public/produk
            $gambar->storeAs('produk', $namaGambar, 'public');

            // Simpan path akses publik
            $validated['gambar'] = 'storage/produk/' . $namaGambar;
        } else {
            $validated['gambar'] = $produk->gambar;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->gambar && Storage::exists(str_replace('storage/', 'public/', $produk->gambar))) {
            Storage::delete(str_replace('storage/', 'public/', $produk->gambar));
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
