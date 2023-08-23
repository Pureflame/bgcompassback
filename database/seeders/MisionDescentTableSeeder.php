<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MisionDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"Introducción",            
            "nombre_mision_dc"=>"Acólito de Saradyn",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"El reposo de Rellegar",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"El asedio de la Torre Celestial",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"La sangre hablará",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"El barón regresa",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"El archivo de Arrizon",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"El ascenso de Urthko",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"1",            
            "nombre_mision_dc"=>"El cruce de Caladen",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"Interludio",            
            "nombre_mision_dc"=>"De entre los restos",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"Interludio",            
            "nombre_mision_dc"=>"Saradyn en llamas",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"El ejército de Dal’Zunm",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"La prisión de Khinn",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"El señor de la llama",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"Muertos o ahogados",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"El Rito del Amanecer Rojo",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"La Montaña Sombraumbría",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"El filo del alba",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"2",            
            "nombre_mision_dc"=>"Penetrando en la oscuridad",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_dcs')->insert([
            "acto_mision_dc"=>"Gran Final",            
            "nombre_mision_dc"=>"Sangre y traición",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
