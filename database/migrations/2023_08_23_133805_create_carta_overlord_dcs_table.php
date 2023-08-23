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
        Schema::create('carta_overlord_dcs', function (Blueprint $table) {
            $table->id();

            $table->string('clase_carta');
            $table->string('nombre_carta');
            $table->integer('coste_carta');
            $table->string('tipo_carta');
            $table->longText('descripcion_carta');
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
        Schema::dropIfExists('carta_overlord_dcs');
    }
};
