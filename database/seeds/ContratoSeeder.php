<?php

use Illuminate\Database\Seeder;
use App\Contratos;
class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Contratos::class)->times(10)->create();
    }
}
