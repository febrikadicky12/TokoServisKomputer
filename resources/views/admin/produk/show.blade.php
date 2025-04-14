@extends('admin.layouts.master')

@section('title', 'Detail Produk')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title mb-0">Detail Produk</h4>
  </div>
  <div class="card-body row">
    <div class="col-md-4 text-center">
      @if($produk->gambar)
        <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid rounded mb-3" alt="{{ $produk->merek }}">
      @else
        <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid rounded mb-3" alt="No Image">
      @endif
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <tr>
          <th>Kode Produk</th>
          <td>{{ $produk->kode_produk }}</td>
        </tr>
        <tr>
          <th>Kategori</th>
          <td>{{ $produk->kategori }}</td>
        </tr>
        <tr>
          <th>Merek</th>
          <td>{{ $produk->merek }}</td>
        </tr>
        <tr>
          <th>Jenis</th>
          <td>{{ $produk->jenis }}</td>
        </tr>
        <tr>
          <th>Spesifikasi</th>
          <td>{{ $produk->spesifikasi }}</td>
        </tr>
        <tr>
          <th>Warna</th>
          <td>{{ $produk->warna }}</td>
        </tr>
        <tr>
          <th>Harga</th>
          <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <th>Stok</th>
          <td>{{ $produk->stok }}</td>
        </tr>
        <tr>
          <th>Kondisi</th>
          <td>{{ $produk->kondisi }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <td>
            <span class="badge bg-{{ $produk->status == 'Tersedia' ? 'success' : ($produk->status == 'Habis' ? 'danger' : 'warning') }}">
              {{ $produk->status }}
            </span>
          </td>
        </tr>
      </table>
      <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
  </div>
</div>
@endsection
