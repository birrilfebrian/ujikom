<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjamans extends Model
{
    use HasFactory;

    // Nama tabel sesuai migrationmu
    protected $table = 'peminjamans';

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali_deadline',
        'tgl_kembali_aktual',
        'status',
    ];

    /**
     * Relasi ke Anggota (Satu peminjaman dimiliki oleh satu anggota)
     */
    public function anggota()
    {
        return $this->belongsTo(Anggotas::class, 'anggota_id');
    }

    /**
     * Relasi ke Buku (Satu peminjaman meminjam satu buku)
     */
    public function buku()
    {
        return $this->belongsTo(Bukus::class, 'buku_id');
    }
}
