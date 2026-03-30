<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggotas extends Model
{
    use HasFactory;

    // Laravel akan mencari tabel 'anggotas', sudah sesuai dengan migrationmu
    protected $fillable = [
        'nama',
        'email',
        'alamat'
    ];

    // Relasi ke Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjamans::class, 'anggota_id');
    }
}
