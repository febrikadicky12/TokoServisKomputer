@extends('admin.layouts.master')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4>Keranjang Belanja</h4>
  <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">+ Tambah Produk</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($keranjang->count() > 0)
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Produk</th>
          <th>Kode Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php $total = 0; @endphp
        @foreach($keranjang as $i => $item)
          @php
            $produk = $item->produk;
          @endphp

          @if($produk)
            @php
              $subtotal = $produk->harga * $item->jumlah;
              $total += $subtotal;
            @endphp
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>
                <img src="{{ asset($produk->gambar) }}" alt="Gambar Produk" width="60" height="60" style="object-fit: cover;">
              </td>
              <td>{{ $produk->merek }} {{ $produk->jenis }}</td>
              <td>{{ $produk->kode_produk }}</td>
              <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
              <td>
                <form action="{{ route('admin.keranjang.update', $item->id) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('PUT')
                  <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" class="form-control form-control-sm" style="width: 60px;">
                  <button type="submit" class="btn btn-sm btn-warning mt-2">Update</button>
                </form>
              </td>
              <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
              <td>
                <form action="{{ route('admin.keranjang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @else
            <tr>
              <td colspan="8" class="text-danger">Produk tidak ditemukan (mungkin sudah dihapus dari database).</td>
            </tr>
          @endif
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6" class="text-end"><strong>Total</strong></td>
          <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="text-start">
    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
  </div>

  <div class="mt-3 text-end">
    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-success">Lanjut ke Pembayaran</a>
  </div>
@else
  <div class="text-center">
    <p>Keranjang masih kosong. Silakan tambahkan produk.</p>
    <a href="{{ route('admin.produk.index') }}" class="btn btn-primary">Tambah Produk</a>
  </div>
@endif
@endsection
