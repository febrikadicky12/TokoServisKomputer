<<<<<<< HEAD
anjay
=======
@extends('admin.layouts.master')

@section('title', 'Halaman Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4>Halaman Pembayaran</h4>
</div>

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($keranjang->count() > 0)
  <form action="{{ route('pembayaran.store') }}" method="POST">
    @csrf
    <!-- Hidden input untuk kode pelanggan -->
    <input type="hidden" name="kode_pelanggan" value="{{ $kodePelanggan }}">

    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @foreach($keranjang as $i => $item)
            @php $produk = $item->produk; @endphp

            @if($produk)
              @php
                $subtotal = $produk->harga * $item->jumlah;
                $total += $subtotal;
              @endphp
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $produk->merek }} {{ $produk->jenis }}</td>
                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
              </tr>
            @else
              <tr>
                <td colspan="5" class="text-danger text-center">
                  Produk tidak ditemukan (mungkin sudah dihapus)
                </td>
              </tr>
            @endif
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Total</th>
            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- Tambahkan hidden total jika dibutuhkan di controller -->
    <input type="hidden" name="total" value="{{ $total }}">

    <div class="mt-4 text-end">
      <a href="{{ route('nota.preview') }}" class="btn btn-success">Lanjut ke Nota Pembayaran</a>
    </div>
  </form>
@else
  <div class="alert alert-info">
    Keranjang kosong.
  </div>
@endif
@endsection
>>>>>>> origin/main
