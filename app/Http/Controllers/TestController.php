<?php

namespace App\Http\Controllers;

use App\FacturaItems;
use App\OrdenServicio_Items;
use App\ordenservicios;
use App\Servicios;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
use Faker\Factory as Faker;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faker = Faker::create();
        $contratos = \App\ordenservicios::select('id_contrato')->where('facturado', '0')->groupBy('id_contrato')->get();

        foreach ($contratos as $contrato) {
            $contrato = $contrato->id_contrato->id;

            $factura = \App\Factura::create([
                'id_contrato' => $contrato,
                'radicada' => 0
            ]);

            $ordenes = ordenservicios::where('id_contrato', $contrato)->get();
            $num_ordenes = count($ordenes);
            $count_ordenes_facturar = $faker->numberBetween(1, $num_ordenes);

            $ordenes = $count_ordenes_facturar > 1 ? $ordenes->random($count_ordenes_facturar) : $ordenes;

            $factura_total = 0;

            foreach ($ordenes as $orden) {
                FacturaItems::create([
                    'id_factura' => $factura->id,
                    'id_orden_servicio' => $orden->id
                ]);
                $orden->facturado = 1;
                $orden->save();
                $factura_total += $orden->orden_total;
            }

            $factura->factura_total = $factura_total;
            $factura->save();

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
