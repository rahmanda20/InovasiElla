<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rabs', function (Blueprint $table) {
            // Biaya Langsung Personil - Profesional Staff
            $table->json('biaya_langsung_personil_profesional_staf')->nullable();
            
            // Biaya Langsung Personil - Tenaga Ahli Sub Profesional
            $table->json('biaya_langsung_personil_tenaga_ahli_sub_profesional')->nullable();
            
            // Biaya Langsung Personil - Tenaga Pendukung
            $table->json('biaya_langsung_personil_tenaga_pendukung')->nullable();
            
            // Biaya Langsung Non Personil - Biaya Operasional Kantor
            $table->json('biaya_langsung_non_personil_biaya_operasional_kantor')->nullable();
            
            // Jumlah total untuk masing-masing bagian
            $table->decimal('jumlah_biaya_langsung_personil_profesional_staf', 15, 2)->default(0);
            $table->decimal('jumlah_biaya_langsung_personil_tenaga_ahli_sub_profesional', 15, 2)->default(0);
            $table->decimal('jumlah_biaya_langsung_personil_tenaga_pendukung', 15, 2)->default(0);
            $table->decimal('jumlah_biaya_langsung_non_personil_biaya_operasional_kantor', 15, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->dropColumn([
                'biaya_langsung_personil_profesional_staf',
                'biaya_langsung_personil_tenaga_ahli_sub_profesional',
                'biaya_langsung_personil_tenaga_pendukung',
                'biaya_langsung_non_personil_biaya_operasional_kantor',
                'jumlah_biaya_langsung_personil_profesional_staf',
                'jumlah_biaya_langsung_personil_tenaga_ahli_sub_profesional',
                'jumlah_biaya_langsung_personil_tenaga_pendukung',
                'jumlah_biaya_langsung_non_personil_biaya_operasional_kantor',
            ]);
        });
    }
};
