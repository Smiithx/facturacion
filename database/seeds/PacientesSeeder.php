<?php

use Illuminate\Database\Seeder;
use App\Paciente;
use Faker\Factory as Faker;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 1; $i <= 20; $i++){
            Paciente::create([
                'documento' => $faker->regexify('[a-z0-9]{8}'),
                'tipo_documento' => $faker->randomElement(array('CC', 'TI','RC','CE','AS','MS','PA')),
                'nombre' => $faker->name,
                'edad' => $faker->numberBetween($min = 1, $max = 90),
                'tipo_edad' => $faker->randomElement(array('Años', 'Meses','Dias')),
                'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'sexo' => $faker->randomElement(array('Masculino','Femenino')),
                'telefono' => $faker->phoneNumber,
                'direccion' => $faker->address,
                'aseguradora' => $faker->company,
                'contrato' => $faker->regexify('[a-z0-9A-Z]{8}'),
                'regimen' => $faker->randomElement(array('Contributivo', 'Subsidiado','Vinculado','Particular','Otro','Desplazado Contributivo','Desplazado Subsidiado','Desplazado Vinculado'))
            ]);
        }
    }
}
