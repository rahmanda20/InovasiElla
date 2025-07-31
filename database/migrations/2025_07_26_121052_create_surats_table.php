<?php

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
            $table->string('file_excel')->nullable();
            $table->string('file_world')->nullable();
            $table->string('file_csv')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
