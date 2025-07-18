<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master', function (Blueprint $table) {
            $table->id();
            $table->json('uraian')->nullable(); // Kolom untuk Uraian (array)
            $table->json('nomor_berita_acara')->nullable(); // Kolom untuk Nomor Berita Acara (array)
            $table->json('tanggal')->nullable(); // Kolom untuk Tanggal (array)
            $table->json('data_organisasi')->nullable(); // Kolom untuk Data Organisasi (array)
            $table->json('keterangan_organisasi')->nullable(); // Kolom untuk Keterangan Organisasi (array)
            $table->json('data_paket')->nullable(); // Kolom untuk Data Paket (array)
            $table->json('keterangan_data_paket')->nullable(); // Kolom untuk Keterangan Data Paket (array)
            $table->json('pejabat_pengadaan')->nullable(); // Kolom untuk Pejabat Pengadaan (array)
            $table->json('keterangan_pengadaan')->nullable(); // Kolom untuk Keterangan Pengadaan (array)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master');
    }
};
