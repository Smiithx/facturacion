<?php

use Illuminate\Database\Seeder;
use App\Paciente;
use Faker\Factory as Faker;
use App\Aseguradora;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Paciente::class)->times(15)->create();
    }
}
