<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('descents')->insert([           
            "oro"=>"0",
            "id_partida_general"=>"1",
            "id_mision_dc"=>"1",   
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
