@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')

{{-- Wrapper Card Pesanan --}}
<div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 40px;">
  
  <!-- Pesanan Diproses -->
  <div style="width: 250px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 20px;">
    <p style="font-weight: bold; color: #555;">PESANAN DIPROSES</p>
    <div style="height: 8px; background: #eee; border-radius: 4px; overflow: hidden; margin-bottom: 8px;">
      <div style="width: 92%; height: 100%; background-color: #17a2b8;"></div>
    </div>
    <span style="font-size: 14px; color: #333;">92%</span>
  </div>

  <!-- Pesanan Pending -->
  <div style="width: 250px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 20px;">
    <p style="font-weight: bold; color: #555;">PESANAN (PENDING)</p>
    <div style="display: flex; align-items: center; font-size: 20px; color: #f39c12;">
      <i class="fas fa-clock" style="margin-right: 8px;"></i> 2
    </div>
  </div>

</div>

{{-- Tambahkan FontAwesome jika mau pakai ikon jam --}}
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

{{-- Section Card Utama --}}
<div class="row gx-4 gy-4">
  <!-- Card Servis -->
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-lg border-0 rounded-4 h-100">
      <div class="card-body text-center py-5">
        <i class="bi bi-tools display-3 text-primary"></i>
        <h4 class="mt-3 fw-bold">Servis</h4>
        <p class="text-muted mb-4">Lihat semua data servis</p>
        <a href="{{ route('servis.index') }}" class="btn btn-lg btn-primary rounded-pill px-4">Lihat Servis</a>
      </div>
    </div>
  </div>

  <!-- Card Produk -->
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-lg border-0 rounded-4 h-100">
      <div class="card-body text-center py-5">
        <i class="bi bi-box-seam display-3 text-warning"></i>
        <h4 class="mt-3 fw-bold">Produk</h4>
        <p class="text-muted mb-4">Kelola semua produk</p>
        <a href="{{ route('produk.index') }}" class="btn btn-lg btn-warning text-white rounded-pill px-4">Kelola Produk</a>
      </div>
    </div>
  </div>

  <!-- Card Riwayat -->
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-lg border-0 rounded-4 h-100">
      <div class="card-body text-center py-5">
        <i class="bi bi-clock-history display-3 text-danger"></i>
        <h4 class="mt-3 fw-bold">Riwayat</h4>
        <p class="text-muted mb-4">Lihat semua riwayat transaksi</p>
        <a href="{{ route('riwayat.index') }}" class="btn btn-lg btn-danger rounded-pill px-4">Riwayat</a>
      </div>
    </div>
  </div>
</div>
@endsection
