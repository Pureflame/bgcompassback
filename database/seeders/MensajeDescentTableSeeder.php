<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MensajeDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mensaje_descents')->insert([
            "texto_mensaje_dc"=>"Texto mensaje 1", 
            "id_conversacion_dc"=>"1", 
            "correo_usuario"=>"joseuser@gmail.com",     

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_descents')->insert([
            "texto_mensaje_dc"=>"Texto mensaje 2", 
            "id_conversacion_dc"=>"1", 
            "correo_usuario"=>"joseuser@gmail.com",           

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_descents')->insert([
            "texto_mensaje_dc"=>"Texto mensaje 3", 
            "id_conversacion_dc"=>"1",     
            "correo_usuario"=>"manolousuario@gmail.com",       

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_descents')->insert([
            "texto_mensaje_dc"=>"Texto mensaje 4", 
            "id_conversacion_dc"=>"2",    
            "correo_usuario"=>"manolousuario@gmail.com",        

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_descents')->insert([
            "texto_mensaje_dc"=>"Texto mensaje 5", 
            "id_conversacion_dc"=>"2", 
            "correo_usuario"=>"joseuser@gmail.com",           

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
