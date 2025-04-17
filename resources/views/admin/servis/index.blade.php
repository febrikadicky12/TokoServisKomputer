@extends('admin.layouts.master')

@section('title', 'Data Servis')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h4>Data Servis</h4>
  <a href="{{ route('admin.servis.create') }}" class="btn btn-primary">+ Tambah Servis</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Pelanggan</th>
        <th>No. Telp</th> {{-- Kolom baru --}}
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($servis as $s)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $s->tanggal ?? '-' }}</td>
          <td>{{ $s->nama_pelanggan ?? '-' }}</td>
          <td>{{ $s->no_telp ?? '-' }}</td> {{-- Baris baru --}}
          <td>{{ $s->deskripsi ?? '-' }}</td>
          <td>
            <a href="{{ route('admin.servis.edit', $s->kode_notaservis) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.servis.destroy', $s->kode_notaservis) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
            <a href="{{ route('admin.servis.cetak', $s->kode_notaservis) }}" target="_blank" class="btn btn-sm btn-info">Cetak Nota</a>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
