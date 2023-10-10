<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MisionGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Túmulo Negro", 
            "numero_mision_gh"=>"1",   
            "objetivo_mision_gh"=>"Matar a todos los enemigos.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Guarida del Túmulo", 
            "numero_mision_gh"=>"2",   
            "objetivo_mision_gh"=>"Matar al Capitán bandido y a todos los enemigos revelados.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Campamento Inox", 
            "numero_mision_gh"=>"3",   
            "objetivo_mision_gh"=>"Matar a un número de enemigos igual al número de personajes por cinco.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Cripta de los Malditos", 
            "numero_mision_gh"=>"4",   
            "objetivo_mision_gh"=>"Matar a todos los enemigos.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Cripta Ruinosa", 
            "numero_mision_gh"=>"5",   
            "objetivo_mision_gh"=>"Matar a todos los enemigos.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Cripta decadente", 
            "numero_mision_gh"=>"6",   
            "objetivo_mision_gh"=>"Revelar la pieza M y matar a todos los enemigos revelados.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Gruta trepidante", 
            "numero_mision_gh"=>"7",   
            "objetivo_mision_gh"=>"Saquear todas las piezas de tesoro.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Almacén de Gloomhaven", 
            "numero_mision_gh"=>"8",   
            "objetivo_mision_gh"=>"Matar a los dos Guardaespaldas inox.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Mina de diamantes", 
            "numero_mision_gh"=>"9",   
            "objetivo_mision_gh"=>"Matar al Supervisor implacable y saquear la pieza de tesoro.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_ghs')->insert([
            "nombre_mision_gh"=>"Plano del Poder Elemental", 
            "numero_mision_gh"=>"10",   
            "objetivo_mision_gh"=>"Matar a todos los enemigos.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
