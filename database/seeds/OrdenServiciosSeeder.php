<?php

use Illuminate\Database\Seeder;
use App\ordenservicios;

class OrdenServiciosSeeder extends Seeder
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
