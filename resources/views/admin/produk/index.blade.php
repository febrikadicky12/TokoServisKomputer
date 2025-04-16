@extends('admin.layouts.master')

@section('title', 'Data Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4>Data Produk</h4>
  <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
  @forelse($produk as $item)
    <div class="col-md-4 mb-4">
      <div class="card h-100">

        {{-- Tampilkan gambar jika ada --}}
        @if($item->gambar)
          <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->merek }}" style="height: 200px; object-fit: cover;">
        @else
          {{-- Gambar default jika tidak ada --}}
          <img src="{{ asset('images/default-product.png') }}" class="card-img-top" alt="Default Image" style="height: 200px; object-fit: cover;">
        @endif

        <div class="card-body">
          <h5 class="card-title text-truncate" style="max-width: 100%;">{{ $item->merek }} {{ $item->jenis }}</h5>
          <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
          <p class="card-text"><strong>Stok:</strong> {{ $item->stok }}</p>
          <p class="card-text"><strong>Supplier:</strong> {{ $item->supplier->nama ?? '-' }}</p>
          <span class="badge bg-{{ $item->status == 'Tersedia' ? 'success' : ($item->status == 'Habis' ? 'danger' : 'warning') }}">
            {{ $item->status }}
          </span>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
          <form action="{{ route('keranjang.tambah') }}" method="POST" class="d-inline-block">
            @csrf
            <input type="hidden" name="produk_kode" value="{{ $item->kode_produk }}">
            <input type="hidden" name="jumlah" value="1">
            <button type="submit" class="btn btn-sm btn-success">+ Keranjang</button>
          </form>

          <div class="d-flex gap-1">
            <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  @empty
    <div class="col-12 text-center">Belum ada produk</div>
  @endforelse
</div>
@endsection
