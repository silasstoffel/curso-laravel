<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarColunaUploadDaCapaDaSerie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('serie', 'foto_capa')) {
            Schema::table('serie', function (Blueprint $table) {
                $table->string('foto_capa')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('serie', 'foto_capa')) {
            Schema::table('serie', function (Blueprint $table) {
                $table->dropColumn(['foto_capa']);
            });
        }
    }
}
