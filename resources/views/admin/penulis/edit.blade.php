@extends('layouts.admin')

@section('title', 'Edit Penulis')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8"> {{-- Lebar 8 kolom agar area biografi lebih luas --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">

                    <h5 class="mb-0 font-weight-bold text-primary">Edit Data Penulis: {{ $penulis->nama_penulis }}</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('penulis.update', $penulis->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Penulis --}}
                        <div class="form-group mb-3">
                            <label for="nama_penulis" class="font-weight-bold">Nama Penulis</label>
                            <input type="text"
                                name="nama_penulis"
                                id="nama_penulis"
                                class="form-control @error('nama_penulis') is-invalid @enderror"
                                value="{{ old('nama_penulis', $penulis->nama_penulis) }}"
                                required>
                            @error('nama_penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Biografi --}}
                        <div class="form-group mb-4">
                            <label for="biografi" class="font-weight-bold">Biografi</label>
                            <textarea name="biografi"
                                id="biografi"
                                rows="5"
                                class="form-control @error('biografi') is-invalid @enderror"
                                placeholder="Tuliskan riwayat singkat penulis..."
                                required>{{ old('biografi', $penulis->biografi) }}</textarea>
                            @error('biografi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('penulis.index') }}" class="btn btn-light border">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="fas fa-save"></i> Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection