<?php

namespace Database\Seeders;

use App\Models\PartyDc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ClasePartyDescentTableSeeder extends Seeder
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
        $overlord->clases()->sync($cartas);
*/

        DB::table('clase_dc_party_dc')->insert([
            "party_dc_id"=>"1",            
            "clase_dc_id"=>"16",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dc_party_dc')->insert([
            "party_dc_id"=>"1",            
            "clase_dc_id"=>"17",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clase_dc_party_dc')->insert([
            "party_dc_id"=>"2",            
            "clase_dc_id"=>"19",
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
