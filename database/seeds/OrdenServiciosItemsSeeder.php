<?php

use Illuminate\Database\Seeder;
use App\OrdenServicio_Items;

class OrdenServiciosItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrdenServicio_Items::class)->times(20)->create();
    }
}
