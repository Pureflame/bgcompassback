<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PartidasJuegosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partidas_juegos')->insert([
            "nombre_partida"=>"Partida Descent 1",
            "correo_usuario"=>"joseuser@gmail.com",
            "nombre_imagen"=>"Descent"
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('partidas_juegos')->insert([
            "nombre_partida"=>"Partida Descent 2",
            "correo_usuario"=>"joseuser@gmail.com",
            "nombre_imagen"=>"Descent"
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('partidas_juegos')->insert([
            "nombre_partida"=>"Partida Descent 3",
            "correo_usuario"=>"pedrousuario@gmail.com",
            "nombre_imagen"=>"Descent"
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
