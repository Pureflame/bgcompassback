<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class EquipamientoPartyGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipamiento_party_ghs')->insert([
            "party_gh_id"=>"1", 
            "equipamiento_gh_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_party_ghs')->insert([
            "party_gh_id"=>"1", 
            "equipamiento_gh_id"=>"4",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_party_ghs')->insert([
            "party_gh_id"=>"2", 
            "equipamiento_gh_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_party_ghs')->insert([
            "party_gh_id"=>"2", 
            "equipamiento_gh_id"=>"3",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_party_ghs')->insert([
            "party_gh_id"=>"3", 
            "equipamiento_gh_id"=>"4",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('equipamiento_party_ghs')->insert([
            "party_gh_id"=>"3", 
            "equipamiento_gh_id"=>"6",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
