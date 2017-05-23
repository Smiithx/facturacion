<?php

namespace App\Http\Controllers;

use App\OrdenServicio_Items;
use App\Servicios;
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
        $servicios = \App\Manuales_servicios::where("id_manual",1)->where("estado","Activo")->get();
        $count_servicios = count($servicios);
        $count_items = $faker->numberBetween(1, ($count_servicios > 10 ? 10: $count_servicios));
        $orden_total = 0;
        $items = $servicios->random($count_items);
        $orden_items = [];
        foreach ($items as $item){
            $cantidad = $faker->numberBetween(1, 10);
            $valor_unitario = $item->costo;
            $copago = $faker->randomFloat(2,0,($valor_unitario * $cantidad));
            $valor_total = ($valor_unitario * $cantidad) - $copago;
            $orden_total += $valor_total;
            $orden_items[] = OrdenServicio_Items::create([
                'id_orden_servicio' => 1,
                'cups' => $item->id_servicio->cups,
                'descripcion' => $item->id_servicio->descripcion,
                'cantidad' => $cantidad,
                'copago' => $copago,
                'valor_unitario' => $valor_unitario,
                'valor_total' => $valor_total,
                'facturado' => 0
            ]);
        }
        dd($servicios,$count_servicios,$count_items,$items,$orden_items);

        dd($test);
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
