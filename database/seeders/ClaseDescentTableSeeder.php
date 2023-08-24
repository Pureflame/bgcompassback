<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ClaseDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Caballero",            
            "nombre_clase_dc"=>"Juramento de Honor",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Elige a otro héroe que esté a 3 casillas o menos de ti y que tenga un monstruo adyacente a él. Coloca tu miniatura en la casilla vacía adyacente al monstruo más próxima y realiza un ataque con un arma Cuerpo a cuerpo contra ese monstruo.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Caballero",            
            "nombre_clase_dc"=>"Avanzar",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Después de derrotar a un monstruo con un ataque para el que hayas utilizado un arma Cuerpo a cuerpo, agota esta carta para moverte como máximo tu valor de Velocidad y efectuar un ataque adicional.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Caballero",            
            "nombre_clase_dc"=>"Defender",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Cuando un héroe adyacente a ti sea seleccionado como objetivo de un ataque, usa esta carta para declararte tú como objetivo del ataque en su lugar. El alcance y la línea de visión se determinan hacia la casilla del héroe al que intentas defender. No es necesario agotar esta carta para utilizarla; basta con declarar que se va a usar.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);







        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Berserker",            
            "nombre_clase_dc"=>"Furia",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque con un arma Cuerpo a cuerpo. Este ataque gana +1 Daño.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Berserker",            
            "nombre_clase_dc"=>"Bruto",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Ganas +4 de Vida. Cada vez que te pongas en pie o te reanime otro héroe, recuperas 2 de Daño adicionales.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Berserker",            
            "nombre_clase_dc"=>"Contraataque",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Después de que un monstruo adyacente a ti resuelva un ataque por el que te hayas visto afectado, agota esta carta para efectuar un ataque con un arma Cuerpo a cuerpo contra el monstruo atacante. Después de resolver este ataque, el monstruo podrá reanudar su activación si no ha sido derrotado.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);






        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Discípulo",            
            "nombre_clase_dc"=>"Plegaria Curativa",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Agota esta carta durante tu turno y elige entre ti o un héroe adyacente. Luego tira 1 dado rojo de Potencia; el héroe escogido recupera tanto Daño como saques en esta tirada.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Discípulo",            
            "nombre_clase_dc"=>"Ataque Bendecido",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque con un arma Cuerpo a Cuerpo. Si infliges al menos 1 Daño (después de la tirada de Defensa), tú y un héroe adyacente a ti de tu elección recuperáis 2 Daño cada uno.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Discípulo",            
            "nombre_clase_dc"=>"Toque Purificador",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Cada vez que utilices la Plegaria curativa, ese héroe podrá descartarse también 1 carta de Estado.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);





        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Portavoz de Espíritus",            
            "nombre_clase_dc"=>"Piel de Piedra",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Cuando tú o un héroe que esté a 3 casillas o menos de ti seáis atacados, agota esta carta antes de que se haga ninguna tirada para añadir 1 dado gris adicional a la reserva de Defensa del héroe atacado.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Portavoz de Espíritus",            
            "nombre_clase_dc"=>"Consunción Espiritual",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque. Si infliges al menos 1 Daño (después de la tirada de defensa), todos los héroes que estén a 3 casillas o menos de ti (incluido tú mismo) recuperan 1 Daño.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Portavoz de Espíritus",            
            "nombre_clase_dc"=>"Compartir el Dolor",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque. Si infliges al menos 1 Daño (después de la tirada de defensa), todas las demás miniaturas que estén en el grupo del monstruo objetivo sufren 1 Daño.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);





        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Nigromante",            
            "nombre_clase_dc"=>"Levantar a los muertos",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Coloca tu ficha de Cadáver reanimado en una casilla vacía adyacente a ti. Sólo puedes controlar 1 Cadáver reanimado. Puedes descartar tu ficha de Cadáver renimado en cualquier momento durante tu turno.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Nigromante",            
            "nombre_clase_dc"=>"Celeridad Mortal",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Cada vez que sufras 1 Fatiga para recibir 1 punto de movimiento, puedes mover después 1 casilla a tu Cadáver reanimado.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Nigromante",            
            "nombre_clase_dc"=>"Reventar Cadáver",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque con un arma de Magia contra la casilla ocupada por tu Cadáver reanimado. Este ataque gana Explosión. No necesitas alcance ni linea de visión hacia esta casilla. Una vez resuelto el ataque, el Cadáver reanimado es derrotado.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);






        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Maestro de las Runas",            
            "nombre_clase_dc"=>"Saber Rúnico",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Mientras tengas equipada un arma de Magia o de Runa, todos tus ataques ganan “Incremento: Sufre 1 Fatiga para ganar +2 Daño”.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Maestro de las Runas",            
            "nombre_clase_dc"=>"Estallido Rúnico",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque con un arma de Runa. Este ataque gana Explosión.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Maestro de las Runas",            
            "nombre_clase_dc"=>"Grabar Runa",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Toda arma que te equipes adquiere el rasgo Runa mientras la tengas equipada.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);





        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Ladrón",            
            "nombre_clase_dc"=>"Codicia",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Busca en una ficha de Búsqueda que esté a 3 casillas o menos de ti.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Ladrón",            
            "nombre_clase_dc"=>"Tasar",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Después de que robes una carta de Búsqueda, puedes descartarla para robar otra. Debes quedarte con la segunda carta de Búsqueda robada.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Ladrón",            
            "nombre_clase_dc"=>"Trucos Sucios",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Acción: Realiza un ataque con un arma Cuerpo a cuerpo o de Hoja. Si este ataque inflige al menos 1 Daño (después de la tirada de defensa), el objetivo queda Aturdido.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);






        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Montaraz",            
            "nombre_clase_dc"=>"Ágil",
            "experiencia_clase_dc"=>"0",            
            "coste_clase_dc"=>"1",
            "descripcion_clase_dc"=>"Cada vez que un monstruo entre en una casilla adyacente a ti, puedes usar esta carta para moverte 1 casilla; después el monstruo puede reanudar su activación. No es necesario agotar esta carta para utilizarla; basta con declarar que se va a usar.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Montaraz",            
            "nombre_clase_dc"=>"Presentir el Peligro",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"2",
            "descripcion_clase_dc"=>"Acción: Agota esta carta para obligar al Señor Supremo a descartar 1 carta de Señor Supremo de su mano al azar.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dcs')->insert([
            "titulo_clase_dc"=>"Montaraz",            
            "nombre_clase_dc"=>"Vista de Águila",
            "experiencia_clase_dc"=>"1",            
            "coste_clase_dc"=>"0",
            "descripcion_clase_dc"=>"Cuando efectúes un ataque con un Arco, las miniaturas aliadas no bloquean tu línea de visión.",  
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
