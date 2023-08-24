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
        Schema::create('administradores', function (Blueprint $table) {
            $table->id();

            $table->string('dni_admin')->unique();
            $table->string('nombre_admin');
            $table->string('apellidos_admin');
            $table->string('contrasenha_admin');
            $table->string('correo_admin')->unique();
            $table->string('telefono_admin');
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
        Schema::dropIfExists('administradores');
    }
};
