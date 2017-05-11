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

    public function buscar($factura, $contrato, $desde, $hasta)
    {
        $Facturas = Factura::select("facturas.id", "facturas.fecha_radicacion", "facturas.factura_total", "glosas.valor_glosa")
            ->join("glosas", "facturas.id", "=", "glosas.id_factura")
            ->where('facturas.id', $factura)
            ->where('radicada', 1)
            ->orWhere('facturas.contrato', $contrato)
            ->whereDate('facturas.created_at', '>=', $desde)
            ->whereDate('facturas.created_at', '<=', $hasta)
            ->get();

        dd($Facturas);

        $cartera_tbody = "";
        foreach ($Facturas as $factura) {
// $fecha  = $factura->fecha_radicacion;
// echo $fecha." Fecha base de datos con ese formato no la suma";
// echo "<br>";
//       $fecha2 = Carbon::now()->addDay();
//       echo $fecha2." fecha carbon asi es que la suma con este formato ";
//       echo "<br>";     
//     $sumardia = $fecha2->addDay(10);
//     echo $sumardia." Resultado de sumar 10 dias a la fecha carbon ";
// $fechafinal = Carbon::createFromFormat('Y-m-d H',$fecha.'13' )->toDateTimeString(); 
//   echo "<br>";
// echo $fechafinal."Pasando la fecha de la BD a formato fecha carbon para suma";
//     $sumardia2 = $fechafinal->addDay(10);
//     echo "<br>";
//     echo $sumardia2."Resultado de sumar fecha Bd";
// }
// }
            $cartera_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
          <td>$factura->fecha_radicacion</td>
         <td>" . number_format($factura->factura_total, 2) . "</td>
          <td>&nbsp</td>
          <td><input style='width: 100%;' type='number' step='0.00' name='valor_abono' required></td>
          <td>" . number_format($factura->valor_glosa, 2) . "</td>
          <td><input style='width: 100%;' type='number' step='0.00' name='retencion' required></td>
          <td></td>
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
