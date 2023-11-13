<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->integer('id_buku', 12);
            $table->string('isbn', 13);
            $table->string('judul_buku', 100);
            $table->string('nama_penulis', 100);
            $table->year('tahun_terbit');
            $table->tinyInteger('jumlah');
            $table->tinyText('deskripsi');
            $table->integer('kode_penerbit')->length(12);
            $table->foreign('kode_penerbit')->references('kode_penerbit')->on('tb_penerbit');
            $table->integer('kode_kategori')->length(12);
            $table->foreign('kode_kategori')->references('kode_kategori')->on('tb_kategoribk');
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
        Schema::dropIfExists('tb_buku');
    }
}