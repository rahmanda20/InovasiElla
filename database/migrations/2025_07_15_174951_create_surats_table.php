<?php

// 1. Migration: create_surats_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('judul_surat');
            $table->string('jenis_dokumen');
            $table->string('jenis_surat');
            $table->string('file_belum_ttd')->nullable();
            $table->string('file_sudah_ttd')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
