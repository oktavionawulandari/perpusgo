<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_jurusan')->insert([
            'nama_jurusan' => 'Pariwisata',
        ]);
        DB::table('tb_jurusan')->insert([
            'nama_jurusan' => 'Administrasi Niaga',
        ]);
        DB::table('tb_jurusan')->insert([
            'nama_jurusan' => 'Akuntansi',
        ]);
        DB::table('tb_jurusan')->insert([
            'nama_jurusan' => 'Teknik Sipil',
        ]);
        DB::table('tb_jurusan')->insert([
            'nama_jurusan' => 'Teknik Mesin',
        ]);
        DB::table('tb_jurusan')->insert([
            'nama_jurusan' => 'Teknik Elektro',
        ]);
    }
}