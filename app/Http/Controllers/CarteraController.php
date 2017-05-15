<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Cartera;
use App\Glosas;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


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

    $factura = Factura::find($request->id_factura);
    $glosa = Glosas::where('id_factura',$request->id_factura)->get();
    $total = $factura->factura_total - ($request->valor_abono + $request->valor_retencion+$glosa[0]->valor_glosa);
      $this->validate($request, [
            'id_factura' => 'required',
            'fecha_vencimiento' => 'required',
            'valor_abono' => 'required|numeric|min:0.01',
            'valor_retencion' => 'required|numeric|min:0.01'           
        ]); 
          
        $cartera = Cartera::create($request->all());  
        $cartera->valor_saldo = $total;
        $cartera->save();  
        flash('cartera creada con exito!');
        return Redirect::to('cartera/create');

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
            <input type='hidden' name='id_factura' value='$factura->id'>
            <td>$factura->fecha_radicacion</td>
          
            <td><input id='cartera_factura_total' data-value='$factura->factura_total' required type='text' name='factura_total' readonly
                                   class='form-control' value=".number_format($factura->factura_total, 2)."></td>
            <td>$date</td>
            <input type='hidden' name='fecha_vencimiento' value='$date'>

          
            <td><input id='cartera_valor_abono' step='0.00'  required type='number' name='valor_abono'  class='form-control'></td>
          

            <td><input id='cartera_glosa' data-value='$factura->valor_glosa' required type='text' name='valor_glosa' readonly
                                   class='form-control' value=".number_format($factura->valor_glosa, 2)."></td>
                                   
            <td><input id='cartera_retencion' step='0.00'  required type='number' name='valor_retencion'    class='form-control'></td>
                     

            <td class='text-right'><input id='cartera_saldo'step='0.00'  required type='text' name='valor_saldo'    class='form-control'></td>
            
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
