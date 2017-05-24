<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ManualesServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Manuales::class)->times(15)->create();
        $manuales = \App\Manuales::all();
        $servicios = \App\Servicios::all();
        $faker = Faker::create();
        $count_max_servicios = count($servicios) / 100;
        foreach ($manuales as $manual){
            $count_servicios = $faker->numberBetween(2, $count_max_servicios);
            $servicios = \App\Servicios::all()->random($count_servicios);
            foreach ($servicios as $servicio){
                $costo = $faker->randomFloat(2, 0);
                \App\Manuales_servicios::create([
                    "id_manual" => $manual->id,
                    "id_servicio" => $servicio->id,
                    "estado" => "Activo",
                    "costo" => $costo
                ]);
            }
        }
    }
}
