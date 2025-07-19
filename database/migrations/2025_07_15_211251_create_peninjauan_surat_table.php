<?php
// database/migrations/xxxx_xx_xx_create_peninjauan_surat_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeninjauanSuratTable extends Migration
{
    public function up()
    {
        Schema::create('peninjauan_surat', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('file_tanpa_ttd'); // Path file tanpa ttd
            $table->string('file_dengan_ttd')->nullable(); // Path file dengan ttd
            $table->timestamps();
        });
    }
   

    public function down()
    {
        Schema::dropIfExists('peninjauan_surat');
    }
}
