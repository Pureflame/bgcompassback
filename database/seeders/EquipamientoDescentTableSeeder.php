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
    }
}
