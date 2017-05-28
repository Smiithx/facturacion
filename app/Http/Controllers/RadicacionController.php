<?php

namespace App\Http\Controllers;

use App\Contratos;
use App\Factura;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RadicacionController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View("radicacion.create.factura");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function radicarContrato()
    {
        $contratos = Contratos::all();
        $datos = ['contratos' => $contratos];
        return View("radicacion.create.contrato", $datos);
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
            'id_factura' => 'required',
            'fecha_radicacion' => 'required',
            'factura' => 'required'
        ]);
        $factura = Factura::findOrFail($request->id_factura);
        $factura->radicada = 1;
        $factura->fecha_radicacion = $request->fecha_radicacion;
        $factura->save();
        flash("Factura <a href='/facturas/$factura->id'>#$factura->id</a> ha sido radicada con éxito!")->success();
        return Redirect::to("/radicacion/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeContrato(Request $request)
    {
        $this->validate($request, [
            'id_contrato' => 'required',
            'fecha_radicacion' => 'required',
            'facturas' => 'required'
        ]);
        $facturas_messages = "";
        foreach ($request->facturas as $id_factura) {
            $factura = Factura::findOrFail($id_factura);
            $factura->radicada = 1;
            $factura->fecha_radicacion = $request->fecha_radicacion;
            $factura->save();
            $facturas_messages .= "<a href='/facturas/$id_factura' target='_blank'>#$id_factura</a>, ";
        }
        $facturas_messages = substr($facturas_messages, 0, -2);
        flash("Las facturas: $facturas_messages. Han sido radicadas exitosamente!")->success();
        return Redirect::to("/radicacion/contrato/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function buscar($desde, $hasta)
    {
        $FacturasRadicadas = Factura::where('radicada', 1)
            ->whereDate('fecha_radicacion', '>=', $desde)
            ->whereDate('fecha_radicacion', '<=', $hasta)->get();

        $radicacion_tbody = "";

        foreach ($FacturasRadicadas as $factura) {
            $radicacion_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
          <td class='text-center'>". number_format($factura->factura_total, 2) ."</td>
          <td class='text-center'>$factura->fecha_radicacion</td>
           </tr>";
        }
        if ($radicacion_tbody != "") {
            return response()->json([
                'success' => 'true',
                'radicacion_tbody' => $radicacion_tbody
            ]);
        } else {
            return response()->json([
                'error' => 'No se encontraron Facturas Radicadas.'
            ]);
        }
    }
}
