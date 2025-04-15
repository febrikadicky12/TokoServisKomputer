@extends('admin.layouts.master')

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
            <td>3 Item<br>Lipstik<br>Bedak</td>
            <td><span class="badge bg-primary">Dikirim</span></td>
            <td><a href="#">Detail</a></td>
          </tr>
          <tr>
            <td>ORD-00124</td>
            <td>11 Apr 2025</td>
            <td>1 Item<br>Serum</td>
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
@endsection
