<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*Tabel users merupakan tabel untuk menyimpan data pegawai yang terdiri atas 
    dua role, yaitu Admin dan Pustakawan*/

    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->char('nip', 10);
            $table->string('nama', 50);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('alamat', 100)->nullable();
            $table->string('no_hp', 12)->nullable();
            $table->string('email')->unique();
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Pustakawan']);
            $table->timestamps();
            $table->enum('mode_tampil', ['show', 'hide']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}