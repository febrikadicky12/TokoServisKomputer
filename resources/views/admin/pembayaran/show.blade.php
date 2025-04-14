@extends('admin.layouts.master')

@section('title', 'Detail Nota Pembayaran')

@section('content')
<div class="container mt-4">
    <h2>Detail Nota Pembayaran</h2>

    @if($nota)
        <!-- Info Nota -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Informasi Nota
            </div>
            <div class="card-body">
                <p><strong>Kode Nota:</strong> {{ $nota->kode_notapembayaran }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($nota->tanggal)->format('d-m-Y H:i') }}</p>
                <p><strong>Kode Pelanggan:</strong> {{ $nota->kode_pelanggan }}</p>
            </div>
        </div>

        <!-- Detail Produk -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Rincian Produk Dibeli
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nota->produks as $produk)
                            <tr>
                                <td>{{ $produk->nama_produk }}</td>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->pivot->kuantitas }}</td>
                                <td>Rp {{ number_format($produk->pivot->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total dan Informasi Transfer -->
        <div class="mb-3">
            <h4>Total Pembayaran: <strong>Rp {{ number_format($nota->total_pembayaran, 0, ',', '.') }}</strong></h4>
        </div>

        <div class="alert alert-info">
            <p><strong>Silakan transfer ke rekening berikut:</strong></p>
            <p>BANK BNI 5926-0102-2614-537 a.n. Dwi Afrika</p>
        </div>

        <!-- Tombol Cetak -->
        <div>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Cetak Nota
            </button>
        </div>
    @else
        <div class="alert alert-warning">
            <p>Nota tidak ditemukan.</p>
        </div>
    @endif
</div>
@endsection
