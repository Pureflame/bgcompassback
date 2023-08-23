<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MazoOverlordDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $overlord = Overlord_Descent::find(1);
        $cartas = [4,5,6,7];
        foreach(Carta_Overlord_Descent::all() as $carta){
            $overlord->cartas()->attach($carta->id);
        }
        */
        

        DB::table('mazo_overlord_dcs')->insert([
            "id_overlord_dc"=>"1",            
            "id_carta_overlord_dc"=>"4",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mazo_overlord_dcs')->insert([
            "id_overlord_dc"=>"1",            
            "id_carta_overlord_dc"=>"5",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mazo_overlord_dcs')->insert([
            "id_overlord_dc"=>"1",            
            "id_carta_overlord_dc"=>"6",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('mazo_overlord_dcs')->insert([
            "id_overlord_dc"=>"1",            
            "id_carta_overlord_dc"=>"7",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
    }
}
