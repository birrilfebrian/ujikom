@extends('layouts.admin')

@section('title', 'Tambah Penulis Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-primary">Tambah Data Penulis</h5>
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

                    <form action="{{ route('penulis.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label for="nama_penulis" class="font-weight-bold">Nama Lengkap Penulis</label>
                            <input type="text" 
                                   name="nama_penulis" 
                                   class="form-control @error('nama_penulis') is-invalid @enderror" 
                                   value="{{ old('nama_penulis') }}" 
                                   placeholder="Contoh: Tere Liye" 
                                   required>
                            @error('nama_penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="biografi" class="font-weight-bold">Biografi Singkat</label>
                            <textarea name="biografi" 
                                      class="form-control @error('biografi') is-invalid @enderror" 
                                      rows="5" 
                                      placeholder="Tuliskan latar belakang singkat penulis...">{{ old('biografi') }}</textarea>
                            <small class="form-text text-muted">Opsional: Anda bisa mengosongkan bagian ini jika belum ada data.</small>
                            @error('biografi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('penulis.index') }}" class="btn btn-light border mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> Simpan Data Penulis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection