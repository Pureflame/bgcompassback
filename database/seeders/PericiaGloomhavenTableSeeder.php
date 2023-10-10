<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PericiaGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Salvaje", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Retira 2 cartas “-1”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Salvaje", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Sustituye 1 carta “-1” por 1 carta “+1”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Ladrona Mental", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Retira 4 cartas “+0”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Ladrona Mental", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Sustituye 2 cartas “+1” por 2 cartas “+2”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Pícara", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Retira 4 cartas “+0”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Pícara", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Sustituye 1 carta “-2” por 1 carta “+0”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Tejedora de Hechizos", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Retira 4 cartas “+0”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_ghs')->insert([
            "clase_pericia_gh"=>"Tejedora de Hechizos", 
            "coste_pericia_gh"=>"1",
            "descripcion_pericia_gh"=>"Añade 1 carta “+0” + ”Aturdimiento”.",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
