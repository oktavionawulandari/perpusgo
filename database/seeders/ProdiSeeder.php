<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Perhotelan',
            'kode_jurusan' => 1,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D4 Manajemen Bisnis Pariwisata',
            'kode_jurusan' => 1,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Administrasi Bisnis',
            'kode_jurusan' => 2,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D4 Manajemen Bisnis Internasional',
            'kode_jurusan' => 2,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Akuntansi',
            'kode_jurusan' => 3,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D4 Akuntansi Perpajakan',
            'kode_jurusan' => 3,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Teknik Sipil',
            'kode_jurusan' => 4,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D4 Manajemen Proyek Konstruksi',
            'kode_jurusan' => 4,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Teknik Mesin',
            'kode_jurusan' => 5,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D4 Teknik Otomasi',
            'kode_jurusan' => 5,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Manajemen Informatika',
            'kode_jurusan' => 6,
        ]);
        DB::table('tb_prodi')->insert([
            'nama_prodi' => 'D3 Teknik Listrik',
            'kode_jurusan' => 6,
        ]);
    }
}