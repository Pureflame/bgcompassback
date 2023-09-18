<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdministradorTableSeeder::class,
            UsuarioTableSeeder::class,
            ImagenesJuegosTableSeeder::class,

            PartidasJuegosTableSeeder::class,
            ClaseDescentTableSeeder::class,
            ConversacionDescentTableSeeder::class,
            EquipamientoDescentTableSeeder::class,
            HeroeDescentTableSeeder::class,
            MisionDescentTableSeeder::class,
            CartaOverlordDescentTableSeeder::class,

            DescentTableSeeder::class,
            
            MazoOverlordDescentTableSeeder::class,
            PartyDescentTableSeeder::class,

            ClasePartyDescentTableSeeder::class,
            EquipamientoPartyDescentTableSeeder::class,
            MensajeDescentTableSeeder::class,
                        
        ]);
    }
}
