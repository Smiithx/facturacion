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
        $ordenservicios = ordenservicios::where('contrato', $contrato)->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)->get();
        $facturar_tbody = "";
        $facturar_total = 0;
        $count = 0;
        foreach ($ordenservicios as $orden) {
            $aseguradora = Aseguradora::find($orden->aseguradora_id);
            $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $orden->created_at);
            $fecha = $fecha->format('Y-m-d');
            $facturar_total += $orden->orden_total;
            $total = number_format($orden->orden_total, 2);
            $facturar_tbody .= "<tr>
          <td class='text-center'><a href='/ordenservicio/$orden->id' target='_blank'>$orden->id</a></td>
          <td>$orden->nombre</td>
          <td>$orden->documento</td>
          <td>$aseguradora->nombre</td>
          <td>$fecha</td>
          <td class='text-right'>$total</td> 
          <td class='text-center'><input name='facturar[]' data-value='$orden->orden_total' data-id='$count' type='checkbox' class='form-control facturar'></td>
           </tr>";
            $count++;
        }
        if ($facturar_tbody != "") {
            return response()->json([
                'success' => 'true',
                'facturar_tbody' => $facturar_tbody,
                'facturar_total' => $facturar_total
            ]);
        } else {
            return response()->json([
                'error' => 'No existen pacientes con ese contrato'
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)    
    {
    $ordenservicios = ordenservicios::where('id', $id)->get();
    $OrdenServicio_Items = OrdenServicio_Items::where('id_orden_servicio', $id)->get();
    $datos = ['ordenservicios'=>$ordenservicios, 'OrdenServicio_Items' => $OrdenServicio_Items];
    
   return view("orden_servicio.show",$datos);


    }

}
