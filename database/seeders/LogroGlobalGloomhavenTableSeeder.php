<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LogroGlobalGloomhavenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logro_global_ghs')->insert([
            "titulo_logro_global_gh"=>"Gobierno de la ciudad: Militarista",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logro_global_ghs')->insert([
            "titulo_logro_global_gh"=>"La comerciante huye",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('logro_global_ghs')->insert([
            "titulo_logro_global_gh"=>"El poder de la mejora",      

        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
