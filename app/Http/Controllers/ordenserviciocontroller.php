<?php
namespace App\Http\Controllers;

use App\Aseguradora;
use App\OrdenServicio_Items;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ordenservicios;
use App\Http\Requests\OrdenServiciosRequest;
use Carbon\Carbon;

class ordenserviciocontroller extends Controller
{
    public function create()
    {

        return View('orden_servicio.create');
        //
    }

    //
    public function store(OrdenServiciosRequest $request)
    {
        $orden_de_servicio = ordenservicios::create([
            'nombre' => $request->nombre,
            'documento' => $request->documento,
            'aseguradora_id' => (double)$request->aseguradora_id,
            'contrato' => $request->contrato
        ]);
        $orden_total = 0;
        for ($i = 0; $i < count($request->cups); $i++) {
            $total = ((double)$request->cantidad[$i] * (double)$request->valor_unitario[$i]) - (double)$request->copago[$i];
            $orden_total += $total;
            OrdenServicio_Items::create([
                'id_orden_servicio' => $orden_de_servicio->id,
                'cups' => $request->cups[$i],
                'descripcion' => $request->descripcion[$i],
                'cantidad' => (double)$request->cantidad[$i],
                'copago' => (double)$request->copago[$i],
                'valor_unitario' => (double)$request->valor_unitario[$i],
                'valor_total' => $total
            ]);
        }
        $orden_de_servicio->orden_total = $orden_total;
        $orden_de_servicio->save();
        return 'Orden registrada';
    }


    public function buscar($contrato, $desde, $hasta)
    {
        $ordenservicios = ordenservicios::where('contrato', $contrato)->whereDate('created_at', '>=', $desde)->whereDate('created_at', '<=', $hasta)->get();
        $facturar_tbody = "";
        $facturar_total = 0;
        $count = 0;
        foreach ($ordenservicios as $orden) {
            $ordenservicio_items = OrdenServicio_Items::find($orden->id);
            $aseguradora = Aseguradora::find($orden->aseguradora_id);
            $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $orden->created_at);
            $fecha = $fecha->format('Y-m-d');
            $total = $ordenservicio_items->valor_total;
            $facturar_total +=  $total;
            $total2 = number_format($ordenservicio_items->valor_total,2);// porque no queria sumar

            $facturar_tbody .= "<tr>
          <td>$orden->id</td>
          <td>$orden->nombre</td>
          <td>$orden->documento</td>
          <td>$aseguradora->nombre</td>
          <td>$fecha</td>
          <td class='text-right'>$total2</td> 
          <td class='text-center'><input type='checkbox'  name='idfacturar[]' value='$orden->id' class='form-control facturar'></td>
           </tr>";

            $count++;

        }
  if ($facturar_tbody != "") {
    
             return response()->json([
                 'success' => 'true',
                'facturar_total' => $facturar_total,
                 'facturar_tbody' => $facturar_tbody
             ]);
        } else {
             return response()->json([
                 'error' => 'No existen pacientes con ese contrato'
             ]);
       }


    }
}
