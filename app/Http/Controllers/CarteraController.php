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
        return "La cartera fue Creada";
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
        
        $Facturas = Factura::select("facturas.id","contratos.diasvencimiento", "facturas.fecha_radicacion", "facturas.factura_total", "glosas.valor_glosa")
            ->join("glosas", "facturas.id", "=", "glosas.id_factura")
            ->join("contratos", "facturas.contrato", "=", "contratos.contrato")           
           ->where('radicada', 1)
           ->where('facturas.id', $factura)
           ->orWhere('facturas.contrato',"$factura")
           ->whereDate('facturas.created_at', '>=', $desde)
          ->whereDate('facturas.created_at', '<=', $hasta)
        ->get();


        $cartera_tbody = "";
        foreach ($Facturas as $factura) {
            $fecha = Carbon::createFromFormat('Y-m-d',  $factura->fecha_radicacion);
          $fecha->addDay($factura->diasvencimiento);
            $date = $fecha->format('d-m-Y');
          

            $cartera_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
          <td>$factura->fecha_radicacion</td>
         <td id='cartera_factura_total'>" . number_format($factura->factura_total, 2) . "</td>
          <td>$date</td>
          <td><input id='valor_abono' style='width: 100%;' type='number' step='0.00' name='cartera_valor_abono' required></td>
          <td>" . number_format($factura->valor_glosa, 2) . "</td>
          <td><input id='cartera_retencion' style='width: 100%;' type='number' step='0.00' name='retencion' required></td>
          <td id='cartera_saldo'></td>
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
