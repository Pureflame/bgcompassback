<?php

namespace Database\Seeders;

use App\Models\CartaOverlordDc;
use App\Models\Descent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MazoOverlordDescentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    /*
        $overlord = Descent::find(1);
        $cartas = [4,5,6,7];
        foreach(CartaOverlordDc::all() as $carta){
            $overlord->cartas()->attach($carta->id);
        }
      */  
        

        DB::table('carta_overlord_dc_descent')->insert([
            "carta_overlord_dc_id"=>"4",
            "descent_id"=>"1", 
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dc_descent')->insert([
            "carta_overlord_dc_id"=>"5",
            "descent_id"=>"1", 
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dc_descent')->insert([
            "carta_overlord_dc_id"=>"6",
            "descent_id"=>"1", 
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('carta_overlord_dc_descent')->insert([
            "carta_overlord_dc_id"=>"7",
            "descent_id"=>"1", 
        //  "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
    }
}
