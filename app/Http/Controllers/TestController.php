<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
use Faker\Factory as Faker;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faker = Faker::create();
        $array = [];
        for($i = 1; $i <= 10; $i++){
            $array[] =[
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
            ];
        }
        dd($array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
