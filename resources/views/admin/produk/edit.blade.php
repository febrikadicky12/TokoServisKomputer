@extends('admin.layouts.master')

@section('title', 'Edit Produk')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Produk</h4>

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" value="{{ $produk->kode_produk }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="Laptop" {{ $produk->kategori == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                <option value="Komputer" {{ $produk->kategori == 'Komputer' ? 'selected' : '' }}>Komputer</option>
                <option value="Komponen" {{ $produk->kategori == 'Komponen' ? 'selected' : '' }}>Komponen</option>
            </select>
            </div>


          <div class="mb-3">
            <label class="form-label">Merek</label>
            <input type="text" name="merek" class="form-control" value="{{ $produk->merek }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" name="jenis" class="form-control" value="{{ $produk->jenis }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control" rows="3" required>{{ $produk->spesifikasi }}</textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control" value="{{ $produk->warna }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Kondisi</label>
            <select name="kondisi" class="form-control" required>
              <option value="Segel" {{ $produk->kondisi == 'Segel' ? 'selected' : '' }}>Segel</option>
              <option value="Buka Segel" {{ $produk->kondisi == 'Buka Segel' ? 'selected' : '' }}>Buka Segel</option>
              <option value="Bekas" {{ $produk->kondisi == 'Bekas' ? 'selected' : '' }}>Bekas</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
              <option value="Tersedia" {{ $produk->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
              <option value="Pesan" {{ $produk->status == 'Pesan' ? 'selected' : '' }}>Pesan</option>
              <option value="Habis" {{ $produk->status == 'Habis' ? 'selected' : '' }}>Habis</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            @if($produk->gambar)
              <img src="{{ asset($produk->gambar) }}" class="mt-2" height="100" alt="Preview">
            @endif
          </div>
        </div>
      </div>

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
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
