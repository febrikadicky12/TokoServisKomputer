<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('supplier')->get(); 
        return view('admin.produk.index', compact('produk'));
    }
    

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.produk.create', compact('suppliers'));
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
            'status' => 'nullable', // bisa dikosongkan, nanti di-handle otomatis
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kode_supplier' => 'nullable|exists:suppliers,kode_supplier',
            ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('produk', $namaGambar, 'public');
            $validated['gambar'] = 'storage/produk/' . $namaGambar;
        }

        $produk = new Produk($validated);
        $produk->updateStatus(); // atur status otomatis
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $suppliers = Supplier::all();
        return view('admin.produk.edit', compact('produk', 'suppliers'));
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
            'status' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kode_supplier' => 'nullable|exists:suppliers,kode_supplier', 
            ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::exists(str_replace('storage/', 'public/', $produk->gambar))) {
                Storage::delete(str_replace('storage/', 'public/', $produk->gambar));
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('produk', $namaGambar, 'public');
            $validated['gambar'] = 'storage/produk/' . $namaGambar;
        }

        $produk->fill($validated);
        $produk->updateStatus(); // atur status otomatis
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function show($id)
    {
        $produk = Produk::with('supplier')->findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }    

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::exists(str_replace('storage/', 'public/', $produk->gambar))) {
            Storage::delete(str_replace('storage/', 'public/', $produk->gambar));
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function tambahStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->tambahStok($request->jumlah);

        return redirect()->back()->with('success', 'Stok produk berhasil ditambahkan.');
    }

    public function kurangiStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->kurangiStok($request->jumlah);

        return redirect()->back()->with('success', 'Stok produk berhasil dikurangi.');
    }

    public function kembalikanStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->tambahStok($request->jumlah); // restore stok

        return redirect()->back()->with('success', 'Stok produk dikembalikan setelah pembatalan.');
    }
}
