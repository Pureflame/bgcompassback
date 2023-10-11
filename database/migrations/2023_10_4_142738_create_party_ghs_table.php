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
        Schema::create('party_ghs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_partida_gh');
            $table->integer('grupo_party_gh');
            $table->unsignedBigInteger('id_heroe_gh');
            $table->string('nombre_party_gh');
            $table->integer('experiencia_party_gh');
            $table->integer('reputacion_party_gh');
            $table->integer('oro_party_gh');
            $table->integer('marcas_party_gh');
            $table->unsignedBigInteger('id_mision_personal_gh');

            
            $table->foreign('id_partida_gh')->references('id')->on('gloomhavens')->cascadeOnDelete();

            $table->foreign('id_heroe_gh')->references('id')->on('heroe_ghs');

            $table->foreign('id_mision_personal_gh')->references('id')->on('mision_personal_ghs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_ghs');
    }
};
