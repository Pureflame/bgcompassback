<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ConversacionDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversacion_descents')->insert([
            "titulo_conversacion_dc"=>"Título discusión Descent 1", 
            "correo_usuario"=>"joseuser@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('conversacion_descents')->insert([
            "titulo_conversacion_dc"=>"Título discusión Descent 2", 
            "correo_usuario"=>"manolousuario@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('conversacion_descents')->insert([
            "titulo_conversacion_dc"=>"Título discusión Descent 3", 
            "correo_usuario"=>"joseuser@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('conversacion_descents')->insert([
            "titulo_conversacion_dc"=>"Título discusión Descent 4", 
            "correo_usuario"=>"manolousuario@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
