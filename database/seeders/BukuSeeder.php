<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_buku')->insert([
            'isbn' => '9786020312552',
            'judul_buku' => 'Rahasia Sukses Seleksi Wawancara',
            'nama_penulis' => 'Suryono Ekotama',
            'tahun_terbit' => 2019,
            'jumlah' => 5,
            'deskripsi' => 'Dapatkan berbagai tips wawancara melalui buku ini',
            'kode_penerbit' => 1,
            'kode_kategori' => 4,
            'mode_tampil' => 'show',
        ]);
    }
}