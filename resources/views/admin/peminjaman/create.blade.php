@extends('layouts.admin')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 font-weight-bold text-primary">Form Transaksi Peminjaman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Nama Anggota</label>
                            <select name="nama_anggota" id="nama_anggota" class="form-control @error('nama_anggota') is-invalid @enderror" required>
                                <option value="">-- Pilih atau Ketik Nama Baru --</option>
                                @foreach($anggotas as $agt)
                                <option value="{{ $agt->nama }}">{{ $agt->nama }} ({{ str_pad($agt->id, 4, '0', STR_PAD_LEFT) }})</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Ketik nama baru jika anggota belum terdaftar.</small>
                            @error('nama_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Buku yang Dipinjam</label>
                            <select name="buku_id" id="buku_id" class="form-control @error('buku_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($bukus as $b)
                                <option value="{{ $b->id }}">{{ $b->judul }} (Stok: {{ $b->stok }})</option>
                                @endforeach
                            </select>
                            @error('buku_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Tanggal Pinjam</label>
                                    <input type="date" name="tgl_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Deadline Kembali</label>
                                    <input type="date" name="tgl_kembali_deadline" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Transaksi
                            </button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-light border">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $('#nama_anggota').select2({
            tags: true,
            placeholder: "-- Pilih atau Ketik Nama Baru --",
            allowClear: true,
            theme: 'classic',
            width: '100%'
        });

        $('#buku_id').select2({
            placeholder: "-- Pilih Buku --",
            theme: 'classic',
            width: '100%'
        });
    });
</script>
@endpush
@endsection