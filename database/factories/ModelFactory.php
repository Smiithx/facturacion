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
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Paciente::class, function (Faker\Generator $faker) {
    return [
        'documento' => $faker->regexify('[a-z0-9]{8}'),
        'tipo_documento' => $faker->randomElement(array('CC', 'TI','RC','CE','AS','MS','PA')),
        'nombre' => $faker->name,
        'edad' => $faker->numberBetween($min = 1, $max = 90),
        'tipo_edad' => $faker->randomElement(array('Años', 'Meses','Dias')),
        'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'sexo' => $faker->randomElement(array('Masculino','Femenino')),
        'telefono' => $faker->phoneNumber,
        'direccion' => $faker->address,
        'contrato' => $faker->regexify('[a-z0-9A-Z]{8}'),
        'regimen' => $faker->randomElement(array('Contributivo', 'Subsidiado','Vinculado','Particular','Otro','Desplazado Contributivo','Desplazado Subsidiado','Desplazado Vinculado'))
    ];
});

$factory->define(App\Aseguradora::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'nit' => $faker->regexify('[a-z0-9A-Z]{8}'), 
        'estado' => $faker->randomElement(array('Activo','Inactivo'))

    ];
});

$factory->define(App\Diagnosticos::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->regexify('[a-z0-9A-Z]{8}'), 
        'descripcion' => $faker->name,
        'estado' => $faker->randomElement(array('Activo','Inactivo'))

    ];
});

$factory->define(App\ordenservicios::class, function (Faker\Generator $faker) {
    $pacientes = \App\Paciente::all();
    $paciente = $pacientes->random();
    return [
        'nombre' => $paciente->nombre,
        'documento' => $paciente->documento,
        'aseguradora_id' => $paciente->aseguradora_id,
        'contrato' => $paciente->contrato
    ];
});
