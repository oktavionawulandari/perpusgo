<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Umum',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Teknologi',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Seni dan Hiburan',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Filsafat dan Psikologi',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Agama',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Sosial',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Bahasa',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Sains dan Matematika',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Literatur dan Sastra',
        ]);
        DB::table('tb_kategoribk')->insert([
            'kategori' => 'Sejarah dan Geografi',
        ]);
    }
}