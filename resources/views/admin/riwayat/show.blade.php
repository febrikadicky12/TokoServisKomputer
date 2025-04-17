@extends('admin.layouts.master')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Detail Transaksi: {{ $nota->kode_notapembayaran }}</h3>

  <table class="table">
    <thead>
      <tr>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($nota->produkDariKeranjang as $produk)
        <tr>
          <td>{{ $produk->nama_produk }}</td>
          <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
          <td>{{ $produk->pivot->jumlah }}</td>
          <td>Rp {{ number_format($produk->pivot->total, 0, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
