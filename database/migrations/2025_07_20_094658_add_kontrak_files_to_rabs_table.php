<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKontrakFilesToRabsTable extends Migration
{
    public function up()
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->string('file_kontrak_ttd')->nullable();
            $table->string('file_kontrak_non_ttd')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->dropColumn(['file_kontrak_ttd', 'file_kontrak_non_ttd']);
        });
    }
}
