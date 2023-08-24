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
        Schema::create('carta_overlord_dc_descent', function (Blueprint $table) {
            $table->unsignedBigInteger('carta_overlord_dc_id');
            $table->unsignedBigInteger('descent_id');

            $table->foreign('carta_overlord_dc_id')->references('id')->on('carta_overlord_dcs');
            $table->foreign('descent_id')->references('id')->on('descents')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carta_overlord_dc_descent');
    }
};
