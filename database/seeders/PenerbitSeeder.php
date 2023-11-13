<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_penerbit')->insert([
            'nama_penerbit' => 'Gramedia Pustaka Utama',
            'alamat_penerbit' => 'Gedung Kompas Gramedia Blok 1 lt. 5, Jl. Palmerah Barat No.29-37, Jakarta 10270',
        ]);
        DB::table('tb_penerbit')->insert([
            'nama_penerbit' => 'Penerbit Erlangga',
            'alamat_penerbit' => 'Jl. H. Baping No. 100, Ciracas, Jakarta Timur, Indonesia',
        ]);
        DB::table('tb_penerbit')->insert([
            'nama_penerbit' => 'PT Elex Media Komputindo',
            'alamat_penerbit' => 'Gedung Gramedia Lt. 6, Jl. Palmerah Selatan, 22 -24 Jakarta Pusat 10270',
        ]);
        DB::table('tb_penerbit')->insert([
            'nama_penerbit' => 'Penerbit Informatika',
            'alamat_penerbit' => 'Jl. Buah Batu no. 52, Bandung',
        ]);
    }
}