@extends('admin.layouts.master')

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
@endsection
