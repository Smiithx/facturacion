<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Glosas;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CarteraController extends Controller
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
        return view("cartera.create");
    }


    public function createcontrato()
    {

        return view("cartera.createcontrato");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saldo = 0;
        $subtotal = $request->cartera_valor_abono + $request->cartera_glosa + $request->retencion;
        
        $saldo = $request->factura_total - $subtotal;
        echo $subtotal."<br>";
        echo $saldo;
        dd($request->all());
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

    public function buscar($factura, $desde, $hasta)
    {

        $Facturas = Factura::select("facturas.id", "contratos.diasvencimiento", "facturas.fecha_radicacion", "facturas.factura_total", "glosas.valor_glosa")
            ->join("glosas", "facturas.id", "=", "glosas.id_factura")
            ->join("contratos", "facturas.id_contrato", "=", "contratos.id")
            ->where('radicada', 1)
            ->where('facturas.id', $factura)
            ->orWhere('facturas.id_contrato', "$factura")
            ->whereDate('facturas.created_at', '>=', $desde)
            ->whereDate('facturas.created_at', '<=', $hasta)
            ->get();


        $cartera_tbody = "";
        foreach ($Facturas as $factura) {
            $fecha = Carbon::createFromFormat('Y-m-d', $factura->fecha_radicacion);
            $fecha->addDay($factura->diasvencimiento);
            $date = $fecha->format('Y-m-d');


            $cartera_tbody .= "<tr>
            <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
            <input type='hidden' name='factura_id' value='$factura->id'>
            <td>$factura->fecha_radicacion</td>
          
            <td><input id='cartera_factura_total' data-value='$factura->factura_total' required type='text' name='factura_total' readonly
                                   class='form-control' value=".number_format($factura->factura_total, 2)."></td>
            <td>$date</td>
            <input type='hidden' name='fecha_vencimiento' value='$date'>

          
            <td><input id='cartera_valor_abono' step='0.00'  required type='number' name='cartera_valor_abono'  class='form-control'></td>
          

            <td><input id='cartera_glosa' data-value='$factura->valor_glosa' required type='text' name='cartera_glosa' readonly
                                   class='form-control' value=".number_format($factura->valor_glosa, 2)."></td>
                                   
            <td><input id='cartera_retencion' step='0.00'  required type='number' name='retencion'    class='form-control'></td>
                     

            <td><input id='cartera_saldo' value = '' type='number'></td>
            
                                    </tr>";
        }

        if ($cartera_tbody != "") {
            return response()->json([
                'success' => 'true',
                'cartera_tbody' => $cartera_tbody
            ]);
        } else {
            return response()->json([
                'error' => 'No se encontraron Facturas.'
            ]);
        }

    }
}
