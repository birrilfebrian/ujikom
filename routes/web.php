<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AuthController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Halaman Utama (Opsional)
Route::get('/', function () {
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('admin.index');

        Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
        Route::get('/buku/tambah', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku/simpan', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/hapus/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');


        Route::get('penulis', [PenulisController::class, 'index'])->name('penulis.index');
        Route::get('penulis/tambah', [PenulisController::class, 'create'])->name('penulis.create');
        Route::post('penulis/simpan', [PenulisController::class, 'store'])->name('penulis.store');
        Route::get('penulis/edit/{id}', [PenulisController::class, 'edit'])->name('penulis.edit');
        Route::put('penulis/update/{id}', [PenulisController::class, 'update'])->name('penulis.update');
        Route::delete('penulis/hapus/{id}', [PenulisController::class, 'destroy'])->name('penulis.destroy');

        Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('kategori/simpan', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('kategori/hapus/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


        Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::post('/anggota/simpan', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::delete('/anggota/hapus/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');


        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::put('/admin/peminjaman/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
        Route::get('/admin/peminjaman/show/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::post('/peminjaman/pinjam', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    });
});
