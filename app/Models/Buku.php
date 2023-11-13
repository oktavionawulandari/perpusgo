<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'tb_buku';
    protected $fillable = [
        'isbn', 'judul_buku', 'nama_penulis', 'tahun_terbit', 'jumlah', 'deskripsi', 'kode_penerbit', 'kode_kategori', 'mode_tampil'
    ];
    protected $primaryKey = 'id_buku';
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'kode_penerbit');
    }
    public function kategoribk()
    {
        return $this->belongsTo(KategoriBuku::class, 'kode_kategori');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kode_kategori');
    }
}