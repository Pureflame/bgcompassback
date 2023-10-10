<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LogrosPartidaGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logros_partida_ghs')->insert([
            "logro_global_gh_id"=>"1", 
            "gloomhaven_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_partida_ghs')->insert([
            "logro_global_gh_id"=>"2", 
            "gloomhaven_id"=>"1",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_partida_ghs')->insert([
            "logro_global_gh_id"=>"3", 
            "gloomhaven_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logros_partida_ghs')->insert([
            "logro_global_gh_id"=>"2", 
            "gloomhaven_id"=>"2",            

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
