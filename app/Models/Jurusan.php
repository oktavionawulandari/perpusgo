<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'tb_jurusan';
    protected $primaryKey = 'kode_jurusan';
    protected $fillable = ['nama_jurusan'];
    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'kode_jurusan');
    }
}