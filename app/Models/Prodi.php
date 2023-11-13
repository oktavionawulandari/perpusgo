<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'tb_prodi';
    protected $primaryKey = 'kode_prodi';
    protected $fillable = ['nama_prodi', 'kode_jurusan'];
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan');
    }
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'kode_prodi');
    }
}