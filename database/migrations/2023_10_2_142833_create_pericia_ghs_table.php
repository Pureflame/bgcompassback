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
        Schema::create('pericia_ghs', function (Blueprint $table) {
            $table->id();

            $table->string('clase_pericia_gh');
            $table->integer('coste_pericia_gh');
            $table->string('descripcion_pericia_gh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pericia_ghs');
    }
};
