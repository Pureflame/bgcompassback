<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class HabilidadGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Pisotear", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Salvaje",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Ojo por Ojo", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Salvaje",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Voluntad Enferma", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Ladrona Mental",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Unirse a la Noche", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Ladrona Mental",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Aislar", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Pícara",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Golpe al Flanco", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Pícara",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Orbes de Fuego", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Tejedora de Hechizos",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('habilidad_ghs')->insert([
            "nombre_habilidad_gh"=>"Erupción Empaladora", 
            "nivel_habilidad_gh"=>"1",
            "clase_habilidad_gh"=>"Tejedora de Hechizos",             

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
