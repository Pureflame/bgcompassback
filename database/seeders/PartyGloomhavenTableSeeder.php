<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PartyGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('party_ghs')->insert([
            "nombre_party_gh"=>"Heroe 1", 
            "experiencia_party_gh"=>"100",
            "reputacion_party_gh"=>"2", 
            "oro_party_gh"=>"10",
            "marcas_party_gh"=>"2", 
            "grupo_party_gh"=>"1",  
            "id_partida_gh"=>"1",
            "id_heroe_gh"=>"1", 
            "id_mision_personal_gh"=>"1",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('party_ghs')->insert([
            "nombre_party_gh"=>"Heroe 2", 
            "experiencia_party_gh"=>"80",
            "reputacion_party_gh"=>"2", 
            "oro_party_gh"=>"20",
            "marcas_party_gh"=>"2", 
            "grupo_party_gh"=>"1",  
            "id_partida_gh"=>"1",
            "id_heroe_gh"=>"2", 
            "id_mision_personal_gh"=>"2",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('party_ghs')->insert([
            "nombre_party_gh"=>"Heroe 3", 
            "experiencia_party_gh"=>"90",
            "reputacion_party_gh"=>"2", 
            "oro_party_gh"=>"30",
            "marcas_party_gh"=>"1", 
            "grupo_party_gh"=>"1",  
            "id_partida_gh"=>"1",
            "id_heroe_gh"=>"3", 
            "id_mision_personal_gh"=>"3",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('party_ghs')->insert([
            "nombre_party_gh"=>"Heroe 4", 
            "experiencia_party_gh"=>"130",
            "reputacion_party_gh"=>"1", 
            "oro_party_gh"=>"60",
            "marcas_party_gh"=>"0", 
            "grupo_party_gh"=>"2",  
            "id_partida_gh"=>"1",
            "id_heroe_gh"=>"4", 
            "id_mision_personal_gh"=>"4",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
