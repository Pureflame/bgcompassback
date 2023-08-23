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
        Schema::create('mazo_overlord_dcs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_overlord_dc');
            $table->unsignedBigInteger('id_carta_overlord_dc');

            $table->foreign('id_overlord_dc')->references('id')->on('descents');
            $table->foreign('id_carta_overlord_dc')->references('id')->on('carta_overlord_dcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mazo_overlord_dcs');
    }
};
