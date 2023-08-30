<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ImagenesJuegosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $imagenUrl = public_path('images\\Descent.jpg');
        $imagenNombre = substr(basename($imagenUrl), 0, -4);

        DB::table('imagenes_juegos')->insert([
            "nombre_imagen"=>$imagenNombre,      
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        $imagenUrl = public_path('images\\Gloomhaven.jpg');
        $imagenNombre = substr(basename($imagenUrl), 0, -4);
        
        DB::table('imagenes_juegos')->insert([
            "nombre_imagen"=>$imagenNombre,      
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
