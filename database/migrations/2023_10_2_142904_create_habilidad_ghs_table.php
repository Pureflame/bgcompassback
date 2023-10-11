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
        Schema::create('habilidad_ghs', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_habilidad_gh');
            $table->integer('nivel_habilidad_gh');
            $table->string('clase_habilidad_gh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habilidad_ghs');
    }
};
