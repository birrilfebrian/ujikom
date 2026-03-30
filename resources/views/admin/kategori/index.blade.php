@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Kelola Kategori Buku</h5>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
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
                            <th>Nama Kategori</th>
                            <th width="25%">Total Koleksi Buku</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $k)
                        <tr>
                            <td>{{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration }}</td>
                            <td class="fw-bold text-dark">{{ $k->nama_kategori }}</td>
                            <td>
                                <span class="badge badge-pill bg-light text-primary border">
                                    {{ $k->bukus_count }} Judul
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-outline-warning me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Menghapus kategori akan mempengaruhi data buku di dalamnya. Lanjutkan?')">
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
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
</div>
@endsection