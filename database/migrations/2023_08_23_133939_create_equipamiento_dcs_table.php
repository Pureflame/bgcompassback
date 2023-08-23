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
        Schema::create('equipamiento_dcs', function (Blueprint $table) {
            $table->id();

            $table->integer('acto_equipamiento_dc');
            $table->string('nombre_equipamiento_dc');
            $table->string('tipo_equipamiento_dc');
            $table->integer('precio_equipamiento_dc');
            $table->string('dado_equipamiento_dc');
            $table->string('espacio_equipamiento_dc');
            $table->longText('descripcion_equipamiento_dc');
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
        Schema::dropIfExists('equipamiento_dcs');
    }
};
