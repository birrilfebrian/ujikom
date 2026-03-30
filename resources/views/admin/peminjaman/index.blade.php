@extends('layouts.admin')

@section('title', 'Data Transaksi Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Daftar Peminjaman Buku</h5>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Transaksi
            </a>
        </div>
        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Deadline</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $pj)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold">{{ $pj->anggota->nama }}</span><br>
                                <small class="text-muted">{{ $pj->anggota->email }}</small>
                            </td>
                            <td>{{ $pj->buku->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($pj->tgl_pinjam)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pj->tgl_kembali_deadline)->format('d/m/Y') }}</td>
                            <td>
                                {{ $pj->tgl_kembali_aktual ? \Carbon\Carbon::parse($pj->tgl_kembali_aktual)->format('d/m/Y') : '-' }}
                            </td>
                            <td>
                                @if($pj->status == 'dipinjam')
                                <span class="badge bg-info text-dark">Sedang Dipinjam</span>
                                @elseif($pj->status == 'kembali')
                                <span class="badge bg-success">Sudah Kembali</span>
                                @else
                                <span class="badge bg-danger">Terlambat</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if($pj->status == 'dipinjam' || $pj->status == 'terlambat')
                                    <form action="{{ route('peminjaman.kembalikan', $pj->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Proses pengembalian buku?')">
                                            <i class="fas fa-undo"></i> Kembalikan
                                        </button>
                                    </form>
                                    @endif
                                    <a href="{{ route('peminjaman.show', $pj->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada transaksi peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $peminjamans->links() }} {{-- Untuk Pagination --}}
            </div>
        </div>
    </div>
</div>
@endsection