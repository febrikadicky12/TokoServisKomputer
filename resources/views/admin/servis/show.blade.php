@extends('admin.layouts.master')

@section('title', 'Detail Servis')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detail Servis</h2>
        <a href="{{ route('admin.servis.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th style="width: 200px;">ID</th>
                    <td>{{ $servis->id }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($servis->tanggal)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $servis->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <th>Kerusakan</th>
                    <td>{{ $servis->kerusakan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $servis->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $servis->status }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('admin.servis.edit', $servis->id) }}" class="btn btn-primary">✏️ Edit</a>

        <form action="{{ route('admin.servis.destroy', $servis->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection
