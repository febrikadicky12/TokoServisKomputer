@extends('admin.layouts.master')

@section('title', 'Data Servis')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h4>Data Servis</h4>
  <a href="{{ route('servis.create') }}" class="btn btn-primary">+ Tambah Servis</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Nama Pelanggan</th>
        <th>Kerusakan</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($servis as $s)
        <tr>
          <td>{{ $s->id }}</td>
          <td>{{ $s->tanggal ?? '-' }}</td>
          <td>{{ $s->nama_pelanggan ?? '-' }}</td>
          <td>{{ $s->kerusakan ?? '-' }}</td>
          <td>
            <span class="badge bg-{{ $s->status === 'Selesai' ? 'success' : 'warning' }}">
              {{ $s->status ?? 'Proses' }}
            </span>
          </td>
          <td>
            <a href="{{ route('servis.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('servis.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
