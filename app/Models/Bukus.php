<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukus extends Model
{
    use HasFactory;

    protected $table = 'bukus';


   protected $fillable = [
    'judul', 
    'penulis_id', 
    'penerbit', 
    'tahun_terbit', 
    'stok'
    ];
   public function penulis()
{
    return $this->belongsTo(Penulis::class, 'penulis_id');
}
}