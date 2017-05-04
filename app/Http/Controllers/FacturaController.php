<?php

namespace App\Http\Controllers;

use App\FacturaItems;
use App\ordenservicios;
use App\Paciente;
use Illuminate\Http\Request;
use App\Factura;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pacientes = Paciente::name($request->get('name'))->orderBy('id', 'DES')->paginate();
        return View('facturas.index', ['pacientes' => $pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('facturas.create');
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'contrato' => 'required',
            'orden' => 'required'
        ]);

        $factura = Factura::create([
            'contrato' => $request->contrato
        ]);

        $total = 0;
        foreach ($request->orden as $id){
            $orden = ordenservicios::find($id);
            FacturaItems::create([
                'id_factura' =>  $factura->id,
                'id_orden_servicio' =>  $orden->id,
            ]);

            $orden->facturado = 1;
            $orden->save();

            $total += $orden->orden_total;
        }

        $factura->factura_total = $total;
        $factura->save();

        return View('facturas.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       

       $facturas = Factura::where('id', $id)->get();
        $FacturaItems = FacturaItems::where('id_factura', $id)->get();

        $datos = ['facturas' => $facturas,'FacturaItems' => $FacturaItems];

     return View("facturas.show", $datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
