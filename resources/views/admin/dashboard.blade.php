@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row gx-4 gy-4"> <!-- tambahkan gx-4 dan gy-4 di row -->
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

  <!-- Card Penjualan -->
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-lg border-0 rounded-4 h-100">
      <div class="card-body text-center py-5">
        <i class="bi bi-cash-coin display-3 text-success"></i>
        <h4 class="mt-3 fw-bold">Penjualan</h4>
        <p class="text-muted mb-4">Lihat semua data penjualan</p>
        <a href="{{ route('penjualan.index') }}" class="btn btn-lg btn-success rounded-pill px-4">Lihat Penjualan</a>
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

  <!-- Card Riwayat Transaksi -->
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-lg border-0 rounded-4 h-100">
      <div class="card-body text-center py-5">
        <i class="bi bi-clock-history display-3 text-danger"></i>
        <h4 class="mt-3 fw-bold">Riwayat</h4>
        <p class="text-muted mb-4">Lihat semua riwayat transaksi</p>
        <a href="{{ route('produk.index') }}" class="btn btn-lg btn-danger rounded-pill px-4">Riwayat</a>
      </div>
    </div>
  </div>
</div>
@endsection
