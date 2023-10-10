<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PericiaPartyGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pericia_party_ghs')->insert([
            "party_gh_id"=>"1", 
            "pericia_gh_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_party_ghs')->insert([
            "party_gh_id"=>"1", 
            "pericia_gh_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_party_ghs')->insert([
            "party_gh_id"=>"2", 
            "pericia_gh_id"=>"4",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_party_ghs')->insert([
            "party_gh_id"=>"2", 
            "pericia_gh_id"=>"5",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_party_ghs')->insert([
            "party_gh_id"=>"3", 
            "pericia_gh_id"=>"6",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('pericia_party_ghs')->insert([
            "party_gh_id"=>"4", 
            "pericia_gh_id"=>"7",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
