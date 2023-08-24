<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class HeroeDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Jain Bosquebello",            
            "arquetipo_heroe_dc"=>"Explorador",
            "capacidad_heroe_dc"=>"Si sufres cualquier cantidad de Daño a causa de un ataque, puedes optar por recibir parte de esa cantidad (o toda) como Fatiga; sin embargo, no puedes sufrir mas Fatiga de lo que te permita tu Aguante.",
            "proeza_heroe_dc"=>"Acción: Puedes moverte usando el doble de tu Velocidad y efectuar un ataque antes, durante o después de este movimiento.",
            "velocidad_heroe_dc"=>"5",            
            "vida_heroe_dc"=>"8",
            "aguante_heroe_dc"=>"5",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"2",
            "conocimiento_heroe_dc"=>"3",
            "voluntad_heroe_dc"=>"2",            
            "percepcion_heroe_dc"=>"4",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Tumbo Cavadura",            
            "arquetipo_heroe_dc"=>"Explorador",
            "capacidad_heroe_dc"=>"Si te atacan mientras estás adyacente a uno o varios héroes, puedes elegir a un héroe adyacente y añadir su reserva de Defensa a la tuya.",
            "proeza_heroe_dc"=>"Acción: Retira tu miniatura del tablero y pon 1 ficha de Héroe en la casilla que ocupaba. Al comienzo de tu próximo turno, coloca tu miniatura en cualquier casilla vacía situada a no más de 4 casillas de tu ficha de Héroe.",
            "velocidad_heroe_dc"=>"4",            
            "vida_heroe_dc"=>"8",
            "aguante_heroe_dc"=>"5",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"1",
            "conocimiento_heroe_dc"=>"2",
            "voluntad_heroe_dc"=>"3",            
            "percepcion_heroe_dc"=>"5",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Ashrian",            
            "arquetipo_heroe_dc"=>"Sanador",
            "capacidad_heroe_dc"=>"Si un monstruo común empieza su activación adyacente a ti, queda Aturdido.",
            "proeza_heroe_dc"=>"Acción: Elige un monstruo que esté a 3 casillas o menos de ti. Todos los monstruos de su grupo quedan Aturdidos.",
            "velocidad_heroe_dc"=>"5",            
            "vida_heroe_dc"=>"10",
            "aguante_heroe_dc"=>"4",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"2",
            "conocimiento_heroe_dc"=>"2",
            "voluntad_heroe_dc"=>"3",            
            "percepcion_heroe_dc"=>"4",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Avric Albright",            
            "arquetipo_heroe_dc"=>"Sanador",
            "capacidad_heroe_dc"=>"Todo héroe que esté a 3 casillas o menos de ti (incluido tú mismo) gana \"Incremento: Recuperas 1 Daño\” para todas sus tiradas de ataque.",
            "proeza_heroe_dc"=>"Acción: Tira 2 dados rojos de Potencia. todo héroe que esté a 3 casillas o menos de ti (incluido tú mismo) puede recuperar tantos Daño como saques en los dados.",
            "velocidad_heroe_dc"=>"4",            
            "vida_heroe_dc"=>"12",
            "aguante_heroe_dc"=>"4",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"2",
            "conocimiento_heroe_dc"=>"3",
            "voluntad_heroe_dc"=>"4",            
            "percepcion_heroe_dc"=>"2",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Viuda Tarha",            
            "arquetipo_heroe_dc"=>"Mago",
            "capacidad_heroe_dc"=>"Una vez por ronda, después de que hagas una tirada de ataque, puedes volver a tirar 1 dado de Ataque o de Potencia. Debes quedarte con el segundo resultado.",
            "proeza_heroe_dc"=>"Acción: Realiza un ataque. Este ataque afecta a 2 monstruos distintos que estén dentro de tu línea de visión. Haz una sola tirada de ataque, pero cada monstruo deberá realizar sus propias tiradas de defensa por separado. Ambos monstruos se consideran objetivos de tu ataque.",
            "velocidad_heroe_dc"=>"4",            
            "vida_heroe_dc"=>"10",
            "aguante_heroe_dc"=>"4",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"2",
            "conocimiento_heroe_dc"=>"4",
            "voluntad_heroe_dc"=>"3",            
            "percepcion_heroe_dc"=>"2",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Leoric del Libro",            
            "arquetipo_heroe_dc"=>"Mago",
            "capacidad_heroe_dc"=>"Todos los monstruos que estén a 3 casillas o menos de ti reciben -1 Daño en todas sus tiradas de ataque (hasta un mínimo de 1).",
            "proeza_heroe_dc"=>"Acción: Realiza un ataque con un arma de Magia. Este ataque ignora el alcance y toma como objetivos a todas las miniaturas adyacentes a ti. Haz una sola tirada de ataque, pera cada miniatura deberá realizar su propia tirada de defensa por separado.",
            "velocidad_heroe_dc"=>"4",            
            "vida_heroe_dc"=>"8",
            "aguante_heroe_dc"=>"5",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"1",
            "conocimiento_heroe_dc"=>"5",
            "voluntad_heroe_dc"=>"2",            
            "percepcion_heroe_dc"=>"3",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Grisban el Sediento",            
            "arquetipo_heroe_dc"=>"Guerrero",
            "capacidad_heroe_dc"=>"Cada vez que realices una acción de descansar, puedes descartarte inmediatamente de 1 carta de estado.",
            "proeza_heroe_dc"=>"Utiliza esta Proeza durante tu turno para realizar 1 acción de ataque (además de las 2 acciones que puedes efectuar en tu turno).",
            "velocidad_heroe_dc"=>"3",            
            "vida_heroe_dc"=>"14",
            "aguante_heroe_dc"=>"4",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"5",
            "conocimiento_heroe_dc"=>"2",
            "voluntad_heroe_dc"=>"3",            
            "percepcion_heroe_dc"=>"1",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('heroe_dcs')->insert([
            "nombre_heroe_dc"=>"Syndrael",            
            "arquetipo_heroe_dc"=>"Guerrero",
            "capacidad_heroe_dc"=>"Si no te has movido en este turno, recuperas 2 Fatiga al final de tu turno.",
            "proeza_heroe_dc"=>"Utiliza esta Proeza durante tu turno y elige a un héroe que esté a 3 casillas o menos de ti. Tanto tú como ese héroe podéis realizar inmediatamente una acción de movimiento (además de las 2 acciones que podéis efectuar en vuestros respectivos turnos).",
            "velocidad_heroe_dc"=>"4",            
            "vida_heroe_dc"=>"12",
            "aguante_heroe_dc"=>"4",
            "defensa_heroe_dc"=>"Gris",            
            "fuerza_heroe_dc"=>"4",
            "conocimiento_heroe_dc"=>"3",
            "voluntad_heroe_dc"=>"2",            
            "percepcion_heroe_dc"=>"2",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
