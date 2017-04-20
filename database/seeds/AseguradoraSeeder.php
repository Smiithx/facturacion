<?php

use Illuminate\Database\Seeder;
use App\Aseguradora;

class AseguradoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Aseguradora::class)->times(20)->create();
    }
}
