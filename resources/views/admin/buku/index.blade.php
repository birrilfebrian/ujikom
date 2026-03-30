@extends('layouts.admin')

@section('title', 'Daftar Buku')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Kelola Data Buku</h5>
            <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Buku
            </a>
        </div>
        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $buku)
                        <tr>
                            <td>{{ ($bukus->currentPage() - 1) * $bukus->perPage() + $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold text-dark">{{ $buku->judul }}</span><br>
                                <small class="text-muted">Kategori: {{ $buku->kategoris->nama_kategori ?? '-' }}</small>
                            </td>
                            <td>{{ $buku->penulis->nama_penulis }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>
                                @if($buku->stok <= 0)
                                    <span class="badge bg-danger">Habis</span>
                                    @elseif($buku->stok <= 5)
                                        <span class="badge bg-warning text-dark">Sisa {{ $buku->stok }}</span>
                                        @else
                                        <span class="badge badge-pill bg-light text-primary border">
                                            {{ $buku->stok }} Eks
                                        </span>
                                        @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-outline-warning me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Data buku belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bukus->links() }}
            </div>
        </div>
    </div>
</div>
@endsection