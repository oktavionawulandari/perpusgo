<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi', 12);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->enum('status_peminjaman', ['dipinjam', 'dikembalikan']);
            $table->integer('denda');
            $table->unsignedinteger('id_anggota')->length(10);
            $table->foreign('id_anggota')->references('id_anggota')->on('tb_anggota');
            $table->integer('id_buku')->length(12);
            $table->foreign('id_buku')->references('id_buku')->on('tb_buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
}