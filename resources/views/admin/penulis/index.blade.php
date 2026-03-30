@extends('layouts.admin')

@section('title', 'Daftar Penulis')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0 font-weight-bold text-primary">Kelola Data Penulis</h5>
            <a href="{{ route('penulis.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Penulis
            </a>
        </div>
        <div class="card-body">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Penulis</th>
                            <th>Biografi</th>
                            <th width="15%">Total Buku</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penulises as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>{{ $p->nama_penulis }}</strong></td>
                            <td>{{ Str::limit($p->biografi, 50) }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $p->bukus->count() }} Buku
                                </span>
                            </td>
                            <td>
                                <div class="d-flex shadow-sm">
                                    <a href="{{ route('penulis.edit', $p->id) }}" class="btn btn-warning btn-sm mr-2 text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('penulis.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Menghapus penulis akan berdampak pada data buku mereka. Yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Data penulis belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection