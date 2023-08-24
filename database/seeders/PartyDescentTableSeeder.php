<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PartyDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('party_dcs')->insert([
            "id_partida_dc"=>"1",            
            "id_heroe_dc"=>"6",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('party_dcs')->insert([
            "id_partida_dc"=>"1",            
            "id_heroe_dc"=>"2",

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
