<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class EquipamientoDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipamiento_dcs')->insert([
            "acto_equipamiento_dc"=>"1",            
            "nombre_equipamiento_dc"=>"Armadura de cuero",
            "tipo_equipamiento_dc"=>"Armadura ligera",
            "precio_equipamiento_dc"=>"75",            
            "dado_equipamiento_dc"=>"Marrón",
            "espacio_equipamiento_dc"=>"Cuerpo",
            "descripcion_equipamiento_dc"=>"Ganas +1 de Vida",            
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dcs')->insert([
            "acto_equipamiento_dc"=>"1",            
            "nombre_equipamiento_dc"=>"Espada Ancha de Acero",
            "tipo_equipamiento_dc"=>"Hoja",
            "precio_equipamiento_dc"=>"100",            
            "dado_equipamiento_dc"=>"Azul, Rojo",
            "espacio_equipamiento_dc"=>"1 Mano",
            "descripcion_equipamiento_dc"=>"Cuerpo a cuerpo. Puedes volver a tirar 1 dado rojo de Potencia una vez en cada tirada de ataque. “Incremento: +1 Daño”.",            
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dcs')->insert([
            "acto_equipamiento_dc"=>"1",            
            "nombre_equipamiento_dc"=>"Tapiz de Maná",
            "tipo_equipamiento_dc"=>"Runa",
            "precio_equipamiento_dc"=>"125",            
            "dado_equipamiento_dc"=>"Ninguno",
            "espacio_equipamiento_dc"=>"Accesorio",
            "descripcion_equipamiento_dc"=>"Después de tirar dados de Ataque, agota esta carta para añadir 1 Incremento a los resultados.",            
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dcs')->insert([
            "acto_equipamiento_dc"=>"1",            
            "nombre_equipamiento_dc"=>"Ballesta",
            "tipo_equipamiento_dc"=>"Arco, Exótica",
            "precio_equipamiento_dc"=>"175",            
            "dado_equipamiento_dc"=>"Azul, Amarillo",
            "espacio_equipamiento_dc"=>"1 Mano",
            "descripcion_equipamiento_dc"=>"A distancia. Perforante 1. “Incremento: +2 Daño”. “Incremento: +1 Daño y mueve al objetivo 1 casilla”.",            
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dcs')->insert([
            "acto_equipamiento_dc"=>"2",            
            "nombre_equipamiento_dc"=>"Cristal de Tival",
            "tipo_equipamiento_dc"=>"Accesorio",
            "precio_equipamiento_dc"=>"175",            
            "dado_equipamiento_dc"=>"Ninguno",
            "espacio_equipamiento_dc"=>"Accesorio",
            "descripcion_equipamiento_dc"=>"Acción: Agota esta carta para tirar 1 dado rojo de Potencia. Recuperas tanto Daño como saques en el dado.",            
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dcs')->insert([
            "acto_equipamiento_dc"=>"2",            
            "nombre_equipamiento_dc"=>"Hacha Trituradora",
            "tipo_equipamiento_dc"=>"Hacha",
            "precio_equipamiento_dc"=>"175",            
            "dado_equipamiento_dc"=>"Azul, Rojo, Rojo",
            "espacio_equipamiento_dc"=>"2 Manos",
            "descripcion_equipamiento_dc"=>"Cuerpo a cuerpo. “Incremento: +1 Daño”. “2 Incrementos: +5 Daño”",            
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
