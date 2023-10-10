<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class GloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gloomhavens')->insert([
            "prosperidad_ciudad_partida_gh"=>"2",       
            "id_partida_general"=>"6", 
            "id_mision_gh"=>"1",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('gloomhavens')->insert([
            "prosperidad_ciudad_partida_gh"=>"1",       
            "id_partida_general"=>"7", 
            "id_mision_gh"=>"2",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('gloomhavens')->insert([
            "prosperidad_ciudad_partida_gh"=>"2",       
            "id_partida_general"=>"8", 
            "id_mision_gh"=>"3",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('gloomhavens')->insert([
            "prosperidad_ciudad_partida_gh"=>"3",       
            "id_partida_general"=>"9", 
            "id_mision_gh"=>"4",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('gloomhavens')->insert([
            "prosperidad_ciudad_partida_gh"=>"4",       
            "id_partida_general"=>"10", 
            "id_mision_gh"=>"5",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
