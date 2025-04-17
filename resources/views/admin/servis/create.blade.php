@extends('admin.layouts.master')

@section('title', 'Tambah Servis')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold">Tambah Servis</h2>
        <a href="{{ route('admin.servis.index') }}" class="btn btn-secondary rounded-pill px-4">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm">
            <strong>⚠️ Terjadi kesalahan:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow rounded-4">
        <div class="card-body px-4 py-4">
            <form action="{{ route('admin.servis.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tanggal" class="form-label"> Tanggal</label>
                    <input type="date" name="tanggal" class="form-control rounded-pill px-3" value="{{ old('tanggal') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label"> Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control rounded-pill px-3" value="{{ old('nama_pelanggan') }}" placeholder="Masukkan nama pelanggan" required>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label"> Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control rounded-pill px-3" 
       value="{{ old('no_telp') }}" placeholder="Contoh: 081234567890"
       maxlength="13" inputmode="numeric"
       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
       required>

                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label"> Deskripsi Kerusakan</label>
                    <textarea name="deskripsi" class="form-control rounded-4 px-3" rows="4" placeholder="Deskripsikan kerusakan..." required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                         Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
