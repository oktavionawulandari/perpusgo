<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;
    protected $table = 'tb_penerbit';
    protected $primaryKey = 'kode_penerbit';
    protected $fillable = ['nama_penerbit', 'alamat_penerbit'];
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kode_penerbit');
    }
}