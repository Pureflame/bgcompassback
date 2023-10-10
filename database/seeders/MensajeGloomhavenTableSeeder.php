<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MensajeGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mensaje_gloomhavens')->insert([
            "texto_mensaje_gh"=>"Texto mensaje Gloomhaven 1", 
            "id_conversacion_gh"=>"1",
            "correo_usuario"=>"joseuser@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_gloomhavens')->insert([
            "texto_mensaje_gh"=>"Texto mensaje Gloomhaven 2", 
            "id_conversacion_gh"=>"1",
            "correo_usuario"=>"joseuser@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_gloomhavens')->insert([
            "texto_mensaje_gh"=>"Texto mensaje Gloomhaven 3", 
            "id_conversacion_gh"=>"1",
            "correo_usuario"=>"manolousuario@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_gloomhavens')->insert([
            "texto_mensaje_gh"=>"Texto mensaje Gloomhaven 4", 
            "id_conversacion_gh"=>"2",
            "correo_usuario"=>"manolousuario@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mensaje_gloomhavens')->insert([
            "texto_mensaje_gh"=>"Texto mensaje Gloomhaven 5", 
            "id_conversacion_gh"=>"2",
            "correo_usuario"=>"joseuser@gmail.com",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
