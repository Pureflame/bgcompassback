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
        Schema::create('conversacion_gloomhavens', function (Blueprint $table) {
            $table->id();

            $table->string('titulo_conversacion_gh');

            $table->string('correo_usuario');
            $table->foreign('correo_usuario')->references('correo_usuario')->on('usuarios')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversacion_gloomhavens');
    }
};
