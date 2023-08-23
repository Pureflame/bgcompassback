<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CartaOverlordDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Universal",            
            "nombre_carta"=>"Resistencia Tenebrosa",
            "coste_carta"=>"1",
            "tipo_carta"=>"Magia",            
            "descripcion_carta"=>"Juega esta carta sobre un monstruo durante tu turno. Tira 2 dados rojos de Potencia. El monstruo recupera tanto Daño como saques en esta tirada.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Universal",            
            "nombre_carta"=>"Planes Maléficos",
            "coste_carta"=>"1",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta durante tu turno. Elige entre Evento, Magia o Trampa. Muestra cartas de la parte superior del mazo de Señor Supremo hasta que salga una carta con el rasgo que has elegido (o hasta que el mazo se quede sin cartas). Añade a tu mano esa carta (si puedes) y descarta todas las demás que se hayan mostrado.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Universal",            
            "nombre_carta"=>"Planificación",
            "coste_carta"=>"1",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta durante tu turno. Mira las 5 primeras cartas del mazo de Señor Supremo y colócalas en la parte superior del mazo en el orden que quieras.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Fuerza Tenebrosa",
            "coste_carta"=>"0",
            "tipo_carta"=>"Magia",            
            "descripcion_carta"=>"Juega esta carta después de que tires los dados para un ataque. Añade 1 Incremento a los resultados.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Fortuna Tenebrosa",
            "coste_carta"=>"0",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta después de que hagas una tirada. Puedes volver a tirar 1 dado.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Trampa de Foso",
            "coste_carta"=>"0",
            "tipo_carta"=>"Trampa",            
            "descripcion_carta"=>"Juega esta carta cuando un héroe entre en una casilla vacía. El héroe realiza una prueba de Percepción. Si la falla, sufre 1 Daño y pierde 1 punto de movimiento. Si no tiene puntos de movimiento que perder (por ejemplo, si había sufrido Fatiga para moverse), queda Aturdido.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Golpe Crítico",
            "coste_carta"=>"0",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta cuando un monstruo ataque a un héroe, después de tirar los dados. El ataque gana “Incremento: +3 Daño”.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Palabra de Aflicción",
            "coste_carta"=>"0",
            "tipo_carta"=>"Magia",            
            "descripcion_carta"=>"Juega esta carta al comienzo de tu turno, cada vez que un héroe sufra cualquier cantidad de Daño, también sufrirá 1 Fatiga.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Acometida",
            "coste_carta"=>"0",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta cuando actives a un monstruo durante tu turno. Ese monstruo puede llevar a cabo una acción de movimiento adicional en este turno (además de sus dos acciones habituales).",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Cable Trampa",
            "coste_carta"=>"0",
            "tipo_carta"=>"Trampa",            
            "descripcion_carta"=>"Juega esta carta cuando un héroe entre en una casilla vacía durante una acción de movimiento. El héroe debe realizar una prueba de Percepción. Si la falla, debe terminar su acción de movimiento (aunque podrá sufrir Fatiga para seguir moviéndose, o realizar una segunda acción de movimiento si ésta era la primera).",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Frenesí",
            "coste_carta"=>"0",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta cuando actives a un monstruo durante tu turno. Ese monstruo puede llevar a cabo una acción de ataque adicional en este turno (además de sus dos acciones habituales).",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Dardo Envenenado",
            "coste_carta"=>"0",
            "tipo_carta"=>"Trampa",            
            "descripcion_carta"=>"Juega esta carta cuando un héroe abra una puerta o busque. El héroe realiza una prueba de Percepción o de Fuerza (a tu elección). Si la supera, robas 1 carta de Señor Supremo. Si falla la prueba, sufre 1 Daño, 1 Fatiga y resulta Envenenado.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Básica",            
            "nombre_carta"=>"Seducción Oscura",
            "coste_carta"=>"0",
            "tipo_carta"=>"Magia",            
            "descripcion_carta"=>"Juega esta carta sobre un héroe al comienzo de tu turno. El héroe realiza una prueba de Voluntad. Si la supera, robas 1 carta de Señor Supremo. Si falla la prueba, puedes llevar a cabo una acción de movimiento o de ataque con ese héroe en este turno como si fuera uno de tus monstruos. No puedes obligarle a sufrir Fatiga ni a usar una Poción, pero sí puedes forzarle a efectuar un ataque contra sí mismo.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Caudillo",            
            "nombre_carta"=>"Furia Sangrienta",
            "coste_carta"=>"1",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta al final de tu turno y elige un monstruo. Ese monstruo lleva a cabo de inmediato 2 acciones de ataque, y luego es derrotado.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Caudillo",            
            "nombre_carta"=>"Fortaleza Tenebrosa",
            "coste_carta"=>"1",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta después de tirar dados de Defensa. Añade 2 Escudos a los resultados.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Caudillo",            
            "nombre_carta"=>"Golpe Diestro",
            "coste_carta"=>"2",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta cuando un monstruo ataque a un héroe, antes de tirar los dados. El ataque gana +2 Daño y “Incremento: Devuelve esta carta a tu mano”.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Caudillo",            
            "nombre_carta"=>"Ansia de Sangre",
            "coste_carta"=>"2",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta cuando un héroe sea derrotado. Roba 2 cartas de Señor Supremo (además de la carta que robas normalmente por derrotar a un héroe).",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dcs')->insert([
            "clase_carta"=>"Caudillo",            
            "nombre_carta"=>"Refuerzo",
            "coste_carta"=>"3",
            "tipo_carta"=>"Evento",            
            "descripcion_carta"=>"Juega esta carta al final de tu turno y elige un monstruo líder que haya sobre el tablero. Coloca monstruos comunes del grupo de ese monstruo en casillas vacías adyacentes al monstruo elegido hasta alcanzar el límite de ese grupo de monstruos.",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
