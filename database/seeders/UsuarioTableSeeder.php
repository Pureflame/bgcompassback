<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            "correo_usuario"=>"manolitogafas@gmail.com",            
            "nombre_usuario"=>"Manolo",
            "contrasenha_usuario"=>Hash::make("Pisswoa0*64"),
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuarios')->insert([
            "correo_usuario"=>"joseuser@gmail.com",            
            "nombre_usuario"=>"Jose",
            "contrasenha_usuario"=>Hash::make("Contrase!a32"),
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuarios')->insert([
            "correo_usuario"=>"pedrousuario@gmail.com",            
            "nombre_usuario"=>"Pedro",
            "contrasenha_usuario"=>Hash::make("Secr#t01122"),
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuarios')->insert([
            "correo_usuario"=>"veleronocturno@gmail.com",            
            "nombre_usuario"=>"Isabel",
            "contrasenha_usuario"=>Hash::make("Nad!ielaS4b3"),
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuarios')->insert([
            "correo_usuario"=>"osoabrazos@gmail.com",            
            "nombre_usuario"=>"Sara",
            "contrasenha_usuario"=>Hash::make("C0s4ocul!a4567"),
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
