<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan baris ini
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    use HasFactory;

    protected $table = 'penulis';

    protected $fillable = [
        'nama_penulis',
        'biografi',
    ];

    
    public function bukus()
    {
        return $this->hasMany(Bukus::class, 'penulis_id');
    }
}