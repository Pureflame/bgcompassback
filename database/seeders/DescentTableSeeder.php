<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('descents')->insert([
            "nombre_partida"=>"Partida Descent Test",            
            "oro"=>"0",
            "correo_usuario"=>"joseuser@gmail.com",
            "id_mision_dc"=>"1",
            "id_overlord_dc"=>"1",    
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
