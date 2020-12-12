<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodio', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numero');
            $table->integer('temporada_id');

            $table->foreign('temporada_id', 'temporada_em_epsodio')
                ->references('id')
                ->on('temporada')
                ->onDelete('CASCADE')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodios');
    }
}
