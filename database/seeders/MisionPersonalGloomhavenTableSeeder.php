<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MisionPersonalGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mision_personal_ghs')->insert([
            "nombre_mision_personal_gh"=>"Buscador de Xorn", 
            "objetivo_mision_personal_gh"=>"Completa 3 escenarios que tengan en su nombre la palabra “Cripta”. Después, desbloquea “Sótano nocivo” (Escenario 52) y sigue la cadena de aventuras hasta terminarla.",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_personal_ghs')->insert([
            "nombre_mision_personal_gh"=>"Clase comerciante", 
            "objetivo_mision_personal_gh"=>"Ten en propiedad 2 objeto de espacio Cabeza, 2 de Cuerpo, 2 de Piernas, 3 de 1 Mano o 2 Manos, y 4 de Objeto.",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_personal_ghs')->insert([
            "nombre_mision_personal_gh"=>"La codicia es buena", 
            "objetivo_mision_personal_gh"=>"Acumula 200 de oro.",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mision_personal_ghs')->insert([
            "nombre_mision_personal_gh"=>"Hallar la cura", 
            "objetivo_mision_personal_gh"=>"Mata a 8 Duendes del bosque. Después, desbloquea “Arboleda olvidada” (Escenario 59) y sigue la cadena de aventuras hasta terminarla.",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
