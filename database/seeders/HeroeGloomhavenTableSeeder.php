<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class HeroeGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heroe_ghs')->insert([
            "clase_heroe_gh"=>"Salvaje",        

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_ghs')->insert([
            "clase_heroe_gh"=>"Ladrona Mental",        

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_ghs')->insert([
            "clase_heroe_gh"=>"Pícara",        

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_ghs')->insert([
            "clase_heroe_gh"=>"Tejedora de Hechizos",        

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
