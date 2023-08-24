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
        Schema::create('clase_dcs', function (Blueprint $table) {
            $table->id();

            $table->string('titulo_clase_dc');
            $table->string('nombre_clase_dc');
            $table->integer('experiencia_clase_dc');
            $table->integer('coste_clase_dc');
            $table->longText('descripcion_clase_dc');
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
        Schema::dropIfExists('clase_dcs');
    }
};
