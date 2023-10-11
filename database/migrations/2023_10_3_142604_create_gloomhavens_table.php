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
        Schema::create('gloomhavens', function (Blueprint $table) {
            $table->id();
            $table->integer('prosperidad_ciudad_partida_gh');

            $table->unsignedBigInteger('id_partida_general');
            $table->foreign('id_partida_general')->references('id')->on('partidas_juegos')->cascadeOnDelete();

            $table->unsignedBigInteger('id_mision_gh');
            $table->foreign('id_mision_gh')->references('id')->on('mision_ghs');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gloomhavens');
    }
};
