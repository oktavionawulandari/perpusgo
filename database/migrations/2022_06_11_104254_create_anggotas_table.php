<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_anggota', function (Blueprint $table) {
            $table->increments('id_anggota');
            $table->char('nim', 10);
            $table->string('nama_anggota', 50);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('alamat', 100)->nullable();
            $table->string('no_hp', 12)->nullable();
            $table->string('email');
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->enum('role', ['Anggota']);
            $table->integer('kode_prodi')->length(12);
            $table->foreign('kode_prodi')->references('kode_prodi')->on('tb_prodi');
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
        Schema::dropIfExists('tb_anggota');
    }
}