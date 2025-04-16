@extends('admin.layouts.master')

<<<<<<< HEAD
@section('title', 'Riwayat')

@section('content')
<h2>Riwayat Transaksi</h2>

<table class="table">
    <thead>
        <tr>
            <th>Kode Pesanan</th>
            <th>Tanggal</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($riwayat as $nota)
        <tr>
            <td>{{ $nota->kode_pesanan }}</td>
            <td>{{ \Carbon\Carbon::parse($nota->tanggal_pembayaran)->format('d M Y') }}</td>
            <td>Rp{{ number_format($nota->total_bayar, 0, ',', '.') }}</td>
            <td>{{ ucfirst($nota->status_pembayaran) }}</td>
            <td><a href="{{ route('admin.riwayat.show', $nota->id) }}" class="btn btn-info btn-sm">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
=======
@section('title', 'Riwayat Pemesanan & Transaksi')

@section('content')
<div class="container py-4">
  <h3 class="mb-4 fw-bold">Riwayat Pemesanan & Transaksi</h3>

  <ul class="nav nav-tabs mb-3" id="riwayatTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pemesanan-tab" data-bs-toggle="tab" data-bs-target="#pemesanan" type="button" role="tab">Riwayat Pemesanan</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="transaksi-tab" data-bs-toggle="tab" data-bs-target="#transaksi" type="button" role="tab">Riwayat Transaksi</button>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="pemesanan" role="tabpanel">
      {{-- Tabel Riwayat Pemesanan --}}
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode Pesanan</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ORD-00123</td>
            <td>12 Apr 2025</td>
            <td>3 Item<br>Laptop</td>
            <td><span class="badge bg-primary">Dikirim</span></td>
            <td><a href="#">Detail</a></td>
          </tr>
          <tr>
            <td>ORD-00124</td>
            <td>11 Apr 2025</td>
            <td>1 Item<br>Komputer</td>
            <td><span class="badge bg-danger">Dibatalkan</span></td>
            <td><a href="#">Detail</a></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="tab-pane fade" id="transaksi" role="tabpanel">
      {{-- Tabel Riwayat Transaksi --}}
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode Pesanan</th>
            <th>Tanggal</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ORD-00123</td>
            <td>12 Apr 2025</td>
            <td>Rp80.000</td>
            <td>Rp80.000</td>
            <td><a href="#">Detail</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
>>>>>>> 788e9c400688d2dbf45faacfbd93203e180a4279
@endsection
