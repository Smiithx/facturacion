<?php

use Illuminate\Database\Seeder;
use App\ordenservicios;
use Faker\Factory as Faker;
use App\Aseguradora;
class OrdendeserviciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(ordenservicios::class)->times(20)->create();
        
    }
}