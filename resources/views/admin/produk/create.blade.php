@extends('admin.layouts.master')

@section('title', 'Tambah Produk')

@section('content')
<div class="card">
  <div class="card-header">
    <h4>Tambah Produk</h4>
  </div>
  <div class="card-body">
<<<<<<< HEAD
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
=======
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
>>>>>>> 788e9c400688d2dbf45faacfbd93203e180a4279
      @csrf

      <div class="mb-3">
        <label>Kode Produk</label>
        <input type="text" name="kode_produk" class="form-control" required>
      </div>

<<<<<<< HEAD
      <div class="form-group">
  <label for="kode_supplier">Supplier</label>
  <select name="kode_supplier" id="kode_supplier" class="form-control" required>
    <option value="">-- Pilih Supplier --</option>
    @foreach($suppliers as $supplier)
      <option value="{{ $supplier->kode_supplier }}"
        {{ old('kode_supplier', $produk->kode_supplier) == $supplier->kode_supplier ? 'selected' : '' }}>
        {{ $supplier->nama }}
      </option>
    @endforeach
  </select>
</div>




      <div class="text-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
=======
      <div class="mb-3">
        <label>Merek</label>
        <input type="text" name="merek" class="form-control" required>
>>>>>>> origin/main
      </div>

      <div class="mb-3">
        <label>Jenis</label>
        <input type="text" name="jenis" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Spesifikasi</label>
        <textarea name="spesifikasi" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label>Warna</label>
        <input type="text" name="warna" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Kategori</label>
        <select name="kategori" class="form-control" required>
          <option value="laptop">Laptop</option>
          <option value="komputer">Komputer</option>
          <option value="komponen">Komponen</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Kondisi</label>
        <select name="kondisi" class="form-control" required>
          <option value="segel">Segel</option>
          <option value="buka segel">Buka Segel</option>
          <option value="second">Second</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
          <option value="Tersedia">Tersedia</option>
          <option value="Habis">Habis</option>
          <option value="PO">PO</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
<<<<<<< HEAD
      <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
=======
      <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
>>>>>>> 788e9c400688d2dbf45faacfbd93203e180a4279
    </form>
  </div>
</div>
@endsection
