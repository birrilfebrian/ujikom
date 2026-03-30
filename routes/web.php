<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;

// Halaman Utama (Opsional)
Route::get('/', function () {
    return view('welcome');
});

// Grouping Route dengan Prefix 'admin'
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/buku', [BukuController::class, 'index'])->name('admin.buku.index');
    Route::get('/buku/tambah', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/simpan', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/hapus/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

    // 3. Pengelolaan Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota/simpan', [AnggotaController::class, 'store'])->name('anggota.store');

    // 4. Transaksi Peminjaman
    Route::get('/transaksi', [PeminjamanController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/pinjam', [PeminjamanController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/kembali/{id}', [PeminjamanController::class, 'update'])->name('transaksi.update');

});