<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_juegos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_imagen')->unique();
            //$table->timestamps();
        });

        DB::unprepared('ALTER TABLE `imagenes_juegos` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `nombre_imagen` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes_juegos');
    }
};
