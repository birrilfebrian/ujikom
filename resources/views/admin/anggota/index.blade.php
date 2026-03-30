@extends('layouts.admin')

@section('title', 'Daftar Anggota')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Data Anggota Perpustakaan</h5>

        </div>
        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger border-0 shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID Member</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Total Pinjam</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotas as $agt)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ str_pad($agt->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="fw-bold text-dark">{{ $agt->nama }}</td>
                            <td>{{ Str::limit($agt->alamat, 50) }}</td>
                            <td>
                                <span class="badge badge-pill bg-light text-primary border">
                                    {{ $agt->peminjamans_count }} Kali
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('anggota.edit', $agt->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('anggota.destroy', $agt->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus anggota ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada anggota terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $anggotas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection