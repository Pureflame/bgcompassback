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
        Schema::create('clase_dc_party_dc', function (Blueprint $table) {
     
            $table->unsignedBigInteger('party_dc_id');
            $table->unsignedBigInteger('clase_dc_id');

            $table->foreign('party_dc_id')->references('id')->on('party_dcs')->cascadeOnDelete();
            $table->foreign('clase_dc_id')->references('id')->on('clase_dcs');
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
        Schema::dropIfExists('clase_dc_party_dc');
    }
};
