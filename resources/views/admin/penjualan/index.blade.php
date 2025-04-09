@extends('admin.layouts.master')

@section('title', 'Etalase Produk')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h3 class="fw-bold">Etalase Laptop & Komputer</h3>
        <p class="text-muted">Lihat berbagai produk tersedia untuk dibeli.</p>
    </div>
</div>

<div class="row">
    @forelse($produk as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                {{-- Gambar Placeholder (jika belum ada kolom gambar) --}}
                <img src="https://via.placeholder.com/300x200?text={{ $item->kategori }}" class="card-img-top" alt="{{ $item->nama }}">

                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama }}</h5>
                    <p class="mb-1"><strong>Kategori:</strong> {{ ucfirst($item->kategori) }}</p>
                    <p class="mb-1"><strong>Jenis:</strong> {{ $item->jenis }}</p>
                    <p class="mb-1"><strong>Merek:</strong> {{ $item->merek }}</p>
                    <p class="mb-1"><strong>Spesifikasi:</strong> {{ Str::limit($item->spesifikasi, 100) }}</p>
                    <p class="mb-1"><strong>Warna:</strong> {{ $item->warna }}</p>
                    <p class="mb-1"><strong>Kondisi:</strong> {{ ucfirst($item->kondisi) }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge bg-{{ $item->status == 'habis' ? 'danger' : ($item->status == 'PO' ? 'warning' : 'success') }}">
                            {{ strtoupper($item->status) }}
                        </span>
                    </p>
                    <p class="fw-bold text-success mt-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </div>

                <div class="card-footer text-center bg-white">
                    @if($item->stok > 0 && $item->status === 'tersedia')
                        <a href="#" class="btn btn-primary btn-sm">Beli Sekarang</a>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Tidak ada produk yang tersedia saat ini.</p>
    @endforelse
</div>
@endsection
