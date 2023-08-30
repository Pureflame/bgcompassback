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
        Schema::create('partidas_juegos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_partida');

            $table->string('correo_usuario');
            $table->foreign('correo_usuario')->references('correo_usuario')->on('usuarios')->noActionOnDelete();

            $table->string('nombre_imagen');
            $table->foreign('nombre_imagen')->references('nombre_imagen')->on('imagenes_juegos')->noActionOnDelete();

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
        Schema::dropIfExists('partidas_juegos');
    }
};
