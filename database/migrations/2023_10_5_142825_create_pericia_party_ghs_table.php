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
        Schema::create('party_gh_pericia_gh', function (Blueprint $table) {
            $table->unsignedBigInteger('party_gh_id');
            $table->unsignedBigInteger('pericia_gh_id');

            $table->foreign('party_gh_id')->references('id')->on('party_ghs')->cascadeOnDelete();
            $table->foreign('pericia_gh_id')->references('id')->on('pericia_ghs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_gh_pericia_gh');
    }
};
