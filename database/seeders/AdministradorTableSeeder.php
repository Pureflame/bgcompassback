<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministradorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administradores')->insert([
            "dni_admin"=>"12345678X",
            "nombre_admin"=>"Brais",
            "apellidos_admin"=>"Moreno",
            "contrasenha_admin"=>Hash::make("Secret0*32"),
            "correo_admin"=>"braisadmin@gmail.com",
            "telefono_admin"=>"+34698142583",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('admines')->insert([
            "dni_admin"=>"56347812D",
            "nombre_admin"=>"Alberto",
            "apellidos_admin"=>"Conde",
            "contrasenha_admin"=>Hash::make("Z0n4Proh!b!d416"),
            "correo_admin"=>"albertoadmin@gmail.com",
            "telefono_admin"=>"+34698891361",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('admines')->insert([
            "dni_admin"=>"87654321S",
            "nombre_admin"=>"Veronica",
            "apellidos_admin"=>"Rascado",
            "contrasenha_admin"=>Hash::make("Ocultad0*64"),
            "correo_admin"=>"veronicadmin@gmail.com",
            "telefono_admin"=>"+34698672353",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
