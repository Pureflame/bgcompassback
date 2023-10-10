<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LogroGrupoGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logro_grupo_ghs')->insert([
            "titulo_logro_grupo_gh"=>"Primeros pasos",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logro_grupo_ghs')->insert([
            "titulo_logro_grupo_gh"=>"Los planes de Jekserah",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logro_grupo_ghs')->insert([
            "titulo_logro_grupo_gh"=>"La orden del Draco",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
