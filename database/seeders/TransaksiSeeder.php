<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_transaksi')->insert([
            'id_buku' => 1,
            'id_anggota' => 1,
            'tanggal_pinjam' => '2022-06-12',
            'tanggal_kembali' => '2022-06-19',
            'status_peminjaman' => 'dipinjam',
            'denda' => 0
        ]);
    }
}