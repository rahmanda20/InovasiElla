<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('masa_pelaksanaan')->nullable();
            $table->string('sumber_dana')->nullable();

            // Data array -> json
            $table->json('uraian_kegiatan_biaya_langsung_personal')->nullable();
            $table->json('uraian_kegiatan_biaya_langsung_non_personal')->nullable();
            $table->json('biaya_langsung_personil_profesional_staf')->nullable();
            $table->json('biaya_langsung_personil_tenaga_ahli_sub_profesional')->nullable();
            $table->json('biaya_langsung_personil_tenaga_pendukung')->nullable();
            $table->json('biaya_langsung_non_personil_biaya_operasional_kantor')->nullable();
            $table->json('biaya_perjalanan_dinas')->nullable();
            $table->json('depresiasi')->nullable();
            $table->json('biaya_pelaporan')->nullable();

            // Jumlah
            $table->double('jumlah_biaya_langsung_personil_profesional_staf')->nullable();
            $table->double('jumlah_biaya_langsung_personil_tenaga_ahli_sub_profesional')->nullable();
            $table->double('jumlah_biaya_langsung_personil_tenaga_pendukung')->nullable();
            $table->double('jumlah_biaya_langsung_non_personil_biaya_operasional_kantor')->nullable();
            $table->double('jumlah_biaya_perjalanan_dinas')->nullable();
            $table->double('jumlah_depresiasi')->nullable();
            $table->double('jumlah_biaya_pelaporan')->nullable();
            $table->double('jumlah_biaya_langsung_personal')->nullable();
            $table->double('jumlah_biaya_langsung_non_personal')->nullable();
            $table->double('total_keseluruhan')->nullable();
            $table->double('ppn')->nullable();

            // Penanggung jawab
            $table->string('nama_penyedia')->nullable();
            $table->string('nama_perusahaan_penyedia')->nullable();
            $table->string('jabatan_penyedia')->nullable();
            $table->string('nama_pejabat_penandatangan_kontrak')->nullable();
            $table->string('jabatan_pejabat')->nullable();
            $table->string('nip_pejabat')->nullable();
            $table->text('terbilang')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rabs');
    }
};
