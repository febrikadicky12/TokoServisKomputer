@extends('admin.layouts.master')

@section('title', 'Data Produk')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h4>Data Produk</h4>
  <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>Kode</th>
        <th>Merek</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($produk as $item)
        <tr>
          <td>{{ $item->kode_produk }}</td>
          <td>{{ $item->merek }}</td>
          <td>{{ $item->jenis }}</td>
          <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
          <td>{{ $item->stok }}</td>
          <td>
            <span class="badge bg-{{ $item->status === 'Tersedia' ? 'success' : ($item->status === 'Habis' ? 'danger' : 'warning') }}">
              {{ $item->status }}
            </span>
          </td>
          <td>
            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center">Tidak ada produk</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
