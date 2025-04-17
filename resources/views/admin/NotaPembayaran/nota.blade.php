@extends('admin.layouts.master')

@section('title', 'Nota Pembelian')

@section('content')
<div class="container mt-5" style="font-family: Arial, sans-serif;">
    <h2 class="mb-4">Nota Pembelian</h2>

    <div class="row">
        {{-- Informasi Pembelian --}}
        <div class="col-md-4">
            <h5>Pembelian</h5>
            <p><strong>ID Pembelian:</strong> {{ $nota->id }}</p>
            <p><strong>Tanggal Pembelian:</strong> {{ \Carbon\Carbon::parse($nota->tanggal)->format('Y-m-d') }}</p>
            <p><strong>Total Keseluruhan:</strong> Rp {{ number_format($nota->total_pembayaran, 0, ',', '.') }}</p>
        </div>

        {{-- Informasi Pembeli --}}
        <div class="col-md-4">
            <h5>Pembeli</h5>
            <p><strong>{{ $nota->pelanggan->nama ?? 'Nama tidak tersedia' }}</strong></p>
            <p>{{ $nota->pelanggan->telepon ?? 'Telepon tidak tersedia' }}</p>
            <p>{{ $nota->pelanggan->email ?? 'Email tidak tersedia' }}</p>
        </div>

        {{-- Informasi Pengiriman --}}
        <div class="col-md-4">
            <h5>Pengiriman</h5>
            <p>{{ $nota->pengiriman->alamat ?? 'Alamat tidak tersedia' }}</p>
            <p>{{ $nota->pengiriman->kecamatan ?? '-' }}, {{ $nota->pengiriman->kabupaten ?? '-' }}</p>
            <p>{{ $nota->pengiriman->kode_pos ?? '-' }}</p>
            <p><strong>Ongkos Kirim:</strong> Rp {{ number_format($nota->pengiriman->ongkir ?? 0, 0, ',', '.') }}</p>
            <p><strong>Ekspedisi:</strong> {{ $nota->pengiriman->ekspedisi ?? '-' }}</p>
        </div>
    </div>

    {{-- Tabel Produk --}}
    <div class="mt-4">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nota->produk ?? [] as $index => $produk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $produk->pivot->kuantitas ?? '-' }}</td>
                        <td>Rp {{ number_format($produk->pivot->total_harga ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada produk dalam nota.</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                    <td><strong>Rp {{ number_format($nota->total_pembayaran, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Informasi Transfer --}}
    <div class="alert alert-info mt-3">
        Silakan lakukan transfer sebesar <strong>Rp {{ number_format($nota->total_pembayaran, 0, ',', '.') }}</strong><br>
        Ke rekening <strong>BNI 5926-0102-2614-537 a.n. Dwi Afrika</strong>
    </div>

    {{-- Aksi --}}
    <div class="d-flex justify-content-between mt-4">
        <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Kembali ke Dashboard</a>
    </div>
</div>
@endsection
