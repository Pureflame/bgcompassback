<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LogrosPartyGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"1", 
            "logro_grupo_gh_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"2", 
            "logro_grupo_gh_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"3", 
            "logro_grupo_gh_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"1", 
            "logro_grupo_gh_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"2", 
            "logro_grupo_gh_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"3", 
            "logro_grupo_gh_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_party_ghs')->insert([
            "party_gh_id"=>"4", 
            "logro_grupo_gh_id"=>"3",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
