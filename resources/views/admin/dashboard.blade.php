@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <!-- Card Servis -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <i class="bi bi-tools display-4 text-primary"></i>
        <h5 class="mt-2">Servis</h5>
        <p class="text-muted">Lihat semua data servis</p>
        <a href="{{ route('servis.index') }}" class="btn btn-primary">Lihat Servis</a>
      </div>
    </div>
  </div>

  <!-- Card Penjualan -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <i class="bi bi-cash-coin display-4 text-success"></i>
        <h5 class="mt-2">Penjualan</h5>
        <p class="text-muted">Lihat semua data penjualan</p>
        <a href="{{ route('penjualan.index') }}" class="btn btn-success">Lihat Penjualan</a>
      </div>
    </div>
  </div>
</div>
@endsection
