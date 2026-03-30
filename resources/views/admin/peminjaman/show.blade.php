@extends('layouts.admin')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6"> {{-- Lebar cukup 6 kolom saja agar tidak terlalu lebar --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold text-primary">Detail Transaksi #{{ $peminjaman->id }}</h5>
                    <span class="badge {{ $peminjaman->status == 'kembali' ? 'bg-success' : ($peminjaman->status == 'terlambat' ? 'bg-danger' : 'bg-info') }}">
                        {{ strtoupper($peminjaman->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Nama Anggota</th>
                            <td>: {{ $peminjaman->anggota->nama }}</td>
                        </tr>
                        <tr>
                            <th>Buku</th>
                            <td>: <strong>{{ $peminjaman->buku->judul }}</strong></td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>: {{ $peminjaman->buku->penulis->nama_penulis }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <td>: {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Deadline Kembali</th>
                            <td>: <span class="text-danger">{{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_deadline)->format('d/m/Y') }}</span></td>
                        </tr>
                        <tr>
                            <th>Realisasi Kembali</th>
                            <td>: {{ $peminjaman->tgl_kembali_aktual ? \Carbon\Carbon::parse($peminjaman->tgl_kembali_aktual)->format('d/m/Y') : '-' }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light border">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        @if($peminjaman->status != 'kembali')
                        <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success" onclick="return confirm('Selesaikan peminjaman ini?')">
                                <i class="fas fa-check"></i> Kembalikan Buku
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection