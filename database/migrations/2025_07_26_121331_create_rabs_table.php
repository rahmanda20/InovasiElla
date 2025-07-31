<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabsTable extends Migration
{
    public function up(): void
    {
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan');
            $table->string('jenis_dokumen');
            $table->string('lokasi');
            $table->string('masa_pelaksanaan');
            $table->string('sumber_dana');

            // JSON columns (array-casted fields)
            $table->json('uraian_kegiatan_biaya_langsung_personal')->nullable();
            $table->json('uraian_kegiatan_biaya_langsung_non_personal')->nullable();
            $table->json('biaya_langsung_personil_profesional_staf')->nullable();
            $table->json('biaya_langsung_personil_tenaga_ahli_sub_profesional')->nullable();
            $table->json('biaya_langsung_personil_tenaga_pendukung')->nullable();
            $table->json('biaya_langsung_non_personil_biaya_operasional_kantor')->nullable();
            $table->json('biaya_perjalanan_dinas')->nullable();
            $table->json('depresiasi')->nullable();
            $table->json('biaya_pelaporan')->nullable();

            // Jumlah per bagian
            $table->decimal('jumlah_biaya_langsung_personil_profesional_staf', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_langsung_personil_tenaga_ahli_sub_profesional', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_langsung_personil_tenaga_pendukung', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_langsung_non_personil_biaya_operasional_kantor', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_perjalanan_dinas', 20, 2)->nullable();
            $table->decimal('jumlah_depresiasi', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_pelaporan', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_langsung_personal', 20, 2)->nullable();
            $table->decimal('jumlah_biaya_langsung_non_personal', 20, 2)->nullable();
            $table->decimal('total_keseluruhan', 20, 2)->nullable();
            $table->decimal('ppn', 20, 2)->nullable();

            // Penyedia & Pejabat
            $table->string('nama_penyedia')->nullable();
            $table->string('nama_perusahaan_penyedia')->nullable();
            $table->string('jabatan_penyedia')->nullable();
            $table->string('nama_pejabat_penandatangan_kontrak')->nullable();
            $table->string('jabatan_pejabat')->nullable();
            $table->string('nip_pejabat')->nullable();

            // Lain-lain
            $table->text('terbilang')->nullable();
            $table->string('file_kontrak_ttd')->nullable();
            $table->string('file_kontrak_non_ttd')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rabs');
    }
}
