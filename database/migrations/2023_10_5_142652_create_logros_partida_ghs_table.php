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
        Schema::create('gloomhaven_logro_global_gh', function (Blueprint $table) {
            $table->unsignedBigInteger('logro_global_gh_id');
            $table->unsignedBigInteger('gloomhaven_id');

            $table->foreign('logro_global_gh_id')->references('id')->on('logro_global_ghs');
            $table->foreign('gloomhaven_id')->references('id')->on('gloomhavens')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gloomhaven_logro_global_gh');
    }
};
