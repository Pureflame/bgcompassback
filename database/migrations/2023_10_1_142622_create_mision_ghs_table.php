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
        Schema::create('mision_ghs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_mision_gh');
            $table->integer('numero_mision_gh');
            $table->string('objetivo_mision_gh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mision_ghs');
    }
};
