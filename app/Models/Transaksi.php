<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = [
        'id_anggota', 'id_buku', 'tanggal_pinjam', 'tanggal_kembali', 'status_peminjaman', 'denda'
    ];
    protected $primaryKey = 'id_transaksi';
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}