<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class EquipamientoGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Botas de Zancadas", 
            "precio_equipamiento_gh"=>"20",    
            "numero_equipamiento_gh"=>"1", 
            "espacio_equipamiento_gh"=>"Piernas", 
            "descripcion_equipamiento_gh"=>"Durante tu movimiento, añade Movimiento +2 a un solo movimiento.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Zapatos Alados", 
            "precio_equipamiento_gh"=>"20",    
            "numero_equipamiento_gh"=>"2", 
            "espacio_equipamiento_gh"=>"Piernas", 
            "descripcion_equipamiento_gh"=>"Durante tu movimiento, añade Salto al movimiento.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Armadura de Piel", 
            "precio_equipamiento_gh"=>"10",    
            "numero_equipamiento_gh"=>"3", 
            "espacio_equipamiento_gh"=>"Cuerpo", 
            "descripcion_equipamiento_gh"=>"Penalización: 2 cartas “-1”. Para las 2 próximas fuentes de daño de ataque que te tomen como objetivo, obtén Escudo 1.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Armadura de cuero", 
            "precio_equipamiento_gh"=>"20",    
            "numero_equipamiento_gh"=>"4", 
            "espacio_equipamiento_gh"=>"Cuerpo", 
            "descripcion_equipamiento_gh"=>"Cuando te ataquen, el atacante sufre Desventaja en el ataque.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Capa de Invisibilidad", 
            "precio_equipamiento_gh"=>"20",    
            "numero_equipamiento_gh"=>"5", 
            "espacio_equipamiento_gh"=>"Cuerpo", 
            "descripcion_equipamiento_gh"=>"Durante tu turno, obtén Invisibilidad.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Lentes Ojo de Águila", 
            "precio_equipamiento_gh"=>"30",    
            "numero_equipamiento_gh"=>"6", 
            "espacio_equipamiento_gh"=>"Cabeza", 
            "descripcion_equipamiento_gh"=>"Durante tu ataque, gana Ventaja en la acción de ataque entera.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Yelmo de Hierro", 
            "precio_equipamiento_gh"=>"10",    
            "numero_equipamiento_gh"=>"7", 
            "espacio_equipamiento_gh"=>"Cabeza", 
            "descripcion_equipamiento_gh"=>"Cuando te ataquen, cualquier carta de Modificador de ataque x2 que robe el enemigo se considera “+0”.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Escudo Triangular", 
            "precio_equipamiento_gh"=>"20",    
            "numero_equipamiento_gh"=>"8", 
            "espacio_equipamiento_gh"=>"1 Mano", 
            "descripcion_equipamiento_gh"=>"Cuando sufras daño por un ataque, obtén Escudo 1 contra ese ataque.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Arco Perforante", 
            "precio_equipamiento_gh"=>"30",    
            "numero_equipamiento_gh"=>"9", 
            "espacio_equipamiento_gh"=>"2 Manos", 
            "descripcion_equipamiento_gh"=>"Durante tu ataque a distancia, ignora todos los valores de Escudo en la acción de ataque entera.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_ghs')->insert([
            "nombre_equipamiento_gh"=>"Martillo de Guerra", 
            "precio_equipamiento_gh"=>"30",    
            "numero_equipamiento_gh"=>"10", 
            "espacio_equipamiento_gh"=>"2 Manos", 
            "descripcion_equipamiento_gh"=>"Durante tu ataque cuerpo a cuerpo, añade Aturdimiento a la acción de ataque entera.",         

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
