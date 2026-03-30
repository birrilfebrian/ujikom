@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6"> {{-- Kita buat lebarnya setengah layar agar tidak terlalu melar --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-primary">Form Tambah Kategori</h5>
                </div>
                <div class="card-body">

                    {{-- Menampilkan Error Validasi jika ada --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="nama_kategori" class="font-weight-bold">Nama Kategori</label>
                            <input type="text"
                                name="nama_kategori"
                                id="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                placeholder="Contoh: Fiksi, Sains, Teknologi"
                                value="{{ old('nama_kategori') }}"
                                required>

                            @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Masukkan nama kategori buku yang baru.</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kategori.index') }}" class="btn btn-light border">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection