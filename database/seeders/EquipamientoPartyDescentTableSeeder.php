<?php

namespace Database\Seeders;

use App\Models\PartyDc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class EquipamientoPartyDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*
        $overlord = PartyDc::find(1);
        $cartas = [1,2];
        $overlord->equipamientos()->sync($cartas);
*/
        DB::table('equipamiento_dc_party_dc')->insert([
            "party_dc_id"=>"1", 
            "equipamiento_dc_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dc_party_dc')->insert([
            "party_dc_id"=>"1", 
            "equipamiento_dc_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_dc_party_dc')->insert([
            "party_dc_id"=>"2", 
            "equipamiento_dc_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
    }
}
