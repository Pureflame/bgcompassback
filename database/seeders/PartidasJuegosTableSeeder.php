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
            "nombre_partida"=>"Partida Descent Test",
            "correo_usuario"=>"joseuser@gmail.com",
            "nombre_imagen"=>"Descent"
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
