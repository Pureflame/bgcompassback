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
        Schema::create('equipamiento_ghs', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_equipamiento_gh');
            $table->integer('precio_equipamiento_gh');
            $table->integer('numero_equipamiento_gh');
            $table->string('espacio_equipamiento_gh');
            $table->string('descripcion_equipamiento_gh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipamiento_ghs');
    }
};
