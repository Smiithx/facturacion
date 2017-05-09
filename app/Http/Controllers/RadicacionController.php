<?php

namespace App\Http\Controllers;

use App\Factura;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RadicacionController extends Controller
{
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
        return View("radicacion.create.contrato");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_factura' => 'required',
            'fecha_radicacion' => 'required',
            'factura' => 'required'
        ]);
        $factura = Factura::findOrFail($request->id_factura);
        $factura->radicada = 1;
        $factura->fecha_radicacion = $request->fecha_radicacion;
        $factura->save();
        flash('Factura radicada con exito!');
        return Redirect::to("/radicacion/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContrato(Request $request)
    {
        $this->validate($request,[
            'contrato' => 'required',
            'fecha_radicacion' => 'required',
            'facturas' => 'required'
        ]);
        foreach ($request->facturas as $id_factura){
            $factura = Factura::findOrFail($id_factura);
            $factura->radicada = 1;
            $factura->fecha_radicacion = $request->fecha_radicacion;
            $factura->save();
        }

        flash('Las facturas han sido radicadas exitosamente!');
        return Redirect::to("/radicacion/contrato/create");
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

    public function buscar($desde, $hasta)
    {
        $FacturasRadicadas = Factura::where('radicada', 1)
            ->whereDate('fecha_radicacion', '>=', $desde)
            ->whereDate('fecha_radicacion', '<=', $hasta)->get();


        $radicacion_tbody = "";

        foreach ($FacturasRadicadas as $factura) {

            $radicacion_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
          <td>$factura->contrato</td>
          <td>$factura->fecha_radicacion</td>
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
