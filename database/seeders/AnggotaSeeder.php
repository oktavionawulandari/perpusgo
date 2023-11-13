<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_anggota')->insert([
            'nim' => '2022145001',
            'nama_anggota' => 'Indah Paramita',
            'tgl_lahir' => '2002-09-01',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jalan Merdeka',
            'no_hp' => '088737243251',
            'email' => 'testingperpusgo4d@gmail.com',
            'role' => 'Anggota',
            'kode_prodi' => 1,
            'username' => 'anggota1',
            'password' => bcrypt('agt12345'),
            'mode_tampil' => 'show',

        ]);
        DB::table('tb_anggota')->insert([
            'nim' => '2022145002',
            'nama_anggota' => 'Cahaya Dewi',
            'tgl_lahir' => '2002-11-01',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jalan Melati',
            'no_hp' => '084737243251',
            'email' => 'testingperpusgo4d@gmail.com',
            'role' => 'Anggota',
            'kode_prodi' => 3,
            'username' => 'anggota2',
            'password' => bcrypt('agt12345'),
            'mode_tampil' => 'show',

        ]);
        DB::table('tb_anggota')->insert([
            'nim' => '2022145003',
            'nama_anggota' => 'Nata Perwira',
            'tgl_lahir' => '2001-11-10',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jalan Pahlawan',
            'no_hp' => '083737243257',
            'email' => 'testingperpusgo4d@gmail.com',
            'role' => 'Anggota',
            'kode_prodi' => 5,
            'username' => 'anggota3',
            'password' => bcrypt('agt12345'),
            'mode_tampil' => 'show',

        ]);
    }
}