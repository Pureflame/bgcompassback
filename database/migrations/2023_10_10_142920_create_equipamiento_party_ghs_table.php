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
        Schema::create('equipamiento_party_ghs', function (Blueprint $table) {
            $table->unsignedBigInteger('party_gh_id');
            $table->unsignedBigInteger('equipamiento_gh_id');

            $table->foreign('party_gh_id')->references('id')->on('party_ghs')->cascadeOnDelete();
            $table->foreign('equipamiento_gh_id')->references('id')->on('equipamiento_ghs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipamiento_party_ghs');
    }
};
