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
        Schema::create('heroe_dcs', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_heroe_dc');
            $table->string('arquetipo_heroe_dc');
            $table->longText('capacidad_heroe_dc');
            $table->longText('proeza_heroe_dc');
            $table->integer('velocidad_heroe_dc');
            $table->integer('vida_heroe_dc');
            $table->integer('aguante_heroe_dc');
            $table->string('defensa_heroe_dc');
            $table->integer('fuerza_heroe_dc');
            $table->integer('conocimiento_heroe_dc');
            $table->integer('voluntad_heroe_dc');
            $table->integer('percepcion_heroe_dc');
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
        Schema::dropIfExists('heroe_dcs');
    }
};
