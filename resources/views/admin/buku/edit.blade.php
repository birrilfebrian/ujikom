@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 font-weight-bold text-primary">Edit Data Buku: {{ $buku->judul }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Judul Buku --}}
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Judul Buku</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $buku->judul) }}" required>
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Penulis --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Penulis</label>
                            <select name="penulis_id" class="form-control @error('penulis_id') is-invalid @enderror" required>
                                @foreach($penulis as $p)
                                <option value="{{ $p->id }}" @selected(old('penulis_id', $buku->penulis_id) == $p->id)>
                                    {{ $p->nama_penulis }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Kategori</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" @selected(old('kategori_id', $buku->kategori_id) == $k->id)>
                                    {{ $k->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Stok Buku</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok', $buku->stok) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                placeholder="Contoh: 2024"
                                value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
                            @error('tahun_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
        <a href="{{ route('buku.index') }}" class="btn btn-light border">Batal</a>
    </div>
    </form>

</div>
</div>
</div>
@endsection