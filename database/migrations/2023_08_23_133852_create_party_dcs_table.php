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
        Schema::create('party_dcs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_partida_dc');
            $table->foreign('id_partida_dc')->references('id')->on('descents');

            $table->unsignedBigInteger('id_heroe_dc');
            $table->foreign('id_heroe_dc')->references('id')->on('heroe_dcs');

            $table->unsignedBigInteger('id_clase_party_dc');
            $table->foreign('id_clase_party_dc')->references('id_clase_party_dc')->on('clase_party_dcs');

            $table->unsignedBigInteger('id_equipamiento_party_dc');
            $table->foreign('id_equipamiento_party_dc')->references('id_equipamiento_party_dc')->on('equipamiento_party_dcs');

            //$table->foreign('id_equipamiento_dc')->references('id_equipamiento_dc')->on('equipamiento_party_descents');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_dcs');
    }
};
