<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\es_VE\Person($faker));
    $faker->addProvider(new Faker\Provider\es_VE\Internet($faker));
    return [
        'name' =>  $faker->firstName. " " . $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'documento' => $faker->nationalId(),
        'cargo' => $faker->randomElement(['medico', 'enfermera','otro'])
    ];
});

$factory->define(App\Paciente::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\es_VE\Person($faker));
    $faker->addProvider(new Faker\Provider\es_VE\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\es_VE\Address($faker));
    $sexo = $faker->randomElement(array('Masculino', 'Femenino'));
    $aseguradora = \App\Aseguradora::all()->random()->id;
    $contrato = \App\Contratos::all()->random()->id;
    return [
        'documento' => $faker->nationalId(),
        'tipo_documento' => $faker->randomElement(array('CC', 'TI', 'RC', 'CE', 'AS', 'MS', 'PA')),
        'nombre' => $faker->firstName($sexo == 'Masculino' ? 'male' : 'female') . " " . $faker->lastName,
        'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'sexo' => $sexo,
        'telefono' => $faker->phoneNumber,
        'direccion' => $faker->address,
        'id_contrato' => $contrato,
        'regimen' => $faker->randomElement(array('Contributivo', 'Subsidiado', 'Vinculado', 'Particular', 'Otro', 'Desplazado Contributivo', 'Desplazado Subsidiado', 'Desplazado Vinculado')),
        'aseguradora_id' => $aseguradora
    ];
});

$factory->define(App\Aseguradora::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\es_VE\Company($faker));
    return [
        'nombre' => $faker->company,
        'nit' => $faker->regexify('[JG][0-9]{9}'),
        'estado' => 'Activo'
    ];
});

$factory->define(App\ordenservicios::class, function (Faker\Generator $faker) {
    $pacientes = \App\Paciente::all();
    $paciente = $pacientes->random();
    return [
        'nombre' => $paciente->nombre,
        'documento' => $paciente->documento,
        'aseguradora_id' => $paciente->aseguradora_id->id,
        'id_contrato' => $paciente->id_contrato->id,
        'id_paciente' => $paciente->id
    ];
});



$factory->define(App\Contratos::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\es_VE\Person($faker));
    $faker->addProvider(new Faker\Provider\es_VE\Company($faker));
    $manual = \App\Manuales::all()->random()->id;
    return [
        'nombre' => $faker->company,
        'nit' => $faker->nationalId(),
        'diasvencimiento' => $faker->numberBetween(30, 60),
        'id_manual' => $manual,
        'porcentaje' => $faker->randomFloat(2, 0.01, 200.00),
        'estado' => 'Activo'
    ];
});

