@extends('layouts.admin')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-primary">Tambah Data Buku</h5>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="judul" class="font-weight-bold">Judul Buku</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="penulis_id" class="font-weight-bold">Penulis</label>
                                    <select name="penulis_id" class="form-control @error('penulis_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Penulis --</option>
                                        @foreach($penulis as $p)
                                        <option value="{{ $p->id }}" @selected(old('penulis_id')==$p->id)>
                                            {{ $p->nama_penulis }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('penulis_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kategori_id" class="font-weight-bold">Kategori</label>
                                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategoris as $k)
                                        <option value="{{ $k->id }}" @selected(old('kategori_id')==$k->id)>
                                            {{ $k->nama_kategori }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_terbit" class="font-weight-bold">Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" placeholder="Contoh: 2024">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="stok" class="font-weight-bold">Stok</label>
                                    <input type="number" name="stok" class="form-control" value="{{ old('stok', 0) }}" required>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('buku.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Buku</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection