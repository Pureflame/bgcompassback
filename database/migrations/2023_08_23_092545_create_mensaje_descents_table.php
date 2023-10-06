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
        Schema::create('mensaje_descents', function (Blueprint $table) {
            $table->id();

            $table->string('texto_mensaje_dc');

            $table->unsignedBigInteger('id_conversacion_dc');
            $table->foreign('id_conversacion_dc')->references('id')->on('conversacion_descents')->cascadeOnDelete();

            $table->string('correo_usuario');
            $table->foreign('correo_usuario')->references('correo_usuario')->on('usuarios')->cascadeOnDelete();

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
        Schema::dropIfExists('mensaje_descents');
    }
};
