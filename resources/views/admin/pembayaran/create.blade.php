@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h2>Konfirmasi Pembayaran</h2>

    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($keranjang as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td>Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp{{ number_format($item->jumlah * $item->produk->harga, 0, ',', '.') }}</td>
                    </tr>
                    @php $total += $item->jumlah * $item->produk->harga; @endphp
                @endforeach
            </tbody>
        </table>

        <h4>Total: Rp{{ number_format($total, 0, ',', '.') }}</h4>

        <button type="submit" class="btn btn-success">Bayar Sekarang</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
