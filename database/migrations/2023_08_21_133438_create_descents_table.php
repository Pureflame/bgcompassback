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
        Schema::create('descents', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_partida');
            $table->integer('oro');

            $table->string('correo_usuario');
            $table->foreign('correo_usuario')->references('correo_usuario')->on('usuarios')->noActionOnDelete();

            $table->unsignedBigInteger('id_mision_dc');
            $table->foreign('id_mision_dc')->references('id')->on('mision_dcs');

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
        Schema::dropIfExists('descents');
    }
};
