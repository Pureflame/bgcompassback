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
        Schema::create('equipamiento_dc_party_dc', function (Blueprint $table) {

            $table->unsignedBigInteger('party_dc_id');
            $table->unsignedBigInteger('equipamiento_dc_id');

            $table->foreign('party_dc_id')->references('id')->on('party_dcs')->cascadeOnDelete();
            $table->foreign('equipamiento_dc_id')->references('id')->on('equipamiento_dcs');
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
        Schema::dropIfExists('equipamiento_dc_party_dc');
    }
};
