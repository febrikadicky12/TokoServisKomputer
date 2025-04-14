@extends('admin.layouts.master')

@section('title', 'Tambah Produk')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Produk</h4>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="kode_produk" class="form-label">Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
              <option value="Laptop">Laptop</option>
              <option value="Komputer">Komputer</option>
              <option value="Komponen">Komponen</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="merek" class="form-label">Merek</label>
            <input type="text" name="merek" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <input type="text" name="jenis" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="spesifikasi" class="form-label">Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control" rows="3" required></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="kondisi" class="form-label">Kondisi</label>
            <select name="kondisi" class="form-control" required>
              <option value="Segel">Segel</option>
              <option value="Buka Segel">Buka Segel</option>
              <option value="Bekas">Bekas</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
              <option value="Tersedia">Tersedia</option>
              <option value="Pesan">Pesan</option>
              <option value="Habis">Habis</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
          </div>
        </div>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
