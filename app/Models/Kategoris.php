<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoris extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kategoris';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_kategori',
    ];


    public function bukus()
    {
        return $this->hasMany(Bukus::class, 'kategori_id');
    }
}
