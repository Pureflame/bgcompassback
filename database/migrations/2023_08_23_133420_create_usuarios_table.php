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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('correo_usuario')->unique();
            $table->string('nombre_usuario');
            $table->string('contrasenha_usuario');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE `usuarios` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `correo_usuario` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
