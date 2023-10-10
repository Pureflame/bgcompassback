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
            "oro"=>"10",
            "id_partida_general"=>"1",
            "id_mision_dc"=>"1",   
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('descents')->insert([           
            "oro"=>"20",
            "id_partida_general"=>"2",
            "id_mision_dc"=>"2",   
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('descents')->insert([           
            "oro"=>"30",
            "id_partida_general"=>"3",
            "id_mision_dc"=>"3",   
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('descents')->insert([           
            "oro"=>"30",
            "id_partida_general"=>"4",
            "id_mision_dc"=>"3",   
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('descents')->insert([           
            "oro"=>"30",
            "id_partida_general"=>"5",
            "id_mision_dc"=>"3",   
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
