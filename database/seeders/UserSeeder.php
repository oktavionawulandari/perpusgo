<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'nip' => '0982345614',
            'nama' => 'Sintya',
            'tgl_lahir' => '1997-09-01',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jalan Melati',
            'no_hp' => '087737243251',
            'email' => 'sintyaa@gmail.com',
            'role' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin12345'),
            'mode_tampil' => 'show',
        ]);
        DB::table('user')->insert([
            'nip' => '0982345615',
            'nama' => 'Oktaviona',
            'tgl_lahir' => '1998-10-01',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jalan Kenanga',
            'no_hp' => '086737243251',
            'email' => 'oktaviona@gmail.com',
            'role' => 'Pustakawan',
            'username' => 'pegawai1',
            'password' => bcrypt('pst12345'),
            'mode_tampil' => 'show',
        ]);
    }
}