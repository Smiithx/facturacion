<?php

use Illuminate\Database\Seeder;
use App\Servicios;
class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              factory(Servicios::class)->times(5)->create();

    }
}
