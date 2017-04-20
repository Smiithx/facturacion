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
        $aseguradoras = Aseguradora::all();
        $pacientes = factory(Paciente::class)->times(20)->create();
        foreach ($pacientes as $paciente){
            $aseguradoras->random()->pacientes()->save($paciente);
        }
    }
}
