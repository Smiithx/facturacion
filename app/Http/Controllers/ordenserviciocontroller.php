<?php
namespace App\Http\Controllers;

use App\Aseguradora;
use App\FacturaItems;
use App\OrdenServicio_Items;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ordenservicios;
use App\Http\Requests\OrdenServiciosRequest;
use Illuminate\Support\Facades\Redirect;
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
        $paciente = \App\Paciente::where("documento", $request->documento)->get()[0];
        $orden_de_servicio = ordenservicios::create([
            'nombre' => $paciente->nombre,
            'documento' => $paciente->documento,
            'id_paciente' => $paciente->id,
            'aseguradora_id' => $paciente->aseguradora_id->id,
            'contrato' => $paciente->contrato
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
                'valor_total' => $total,
                'facturado' => 0
            ]);
        }
        $orden_de_servicio->orden_total = $orden_total;
        $orden_de_servicio->save();
        flash('La orden ha sido registrada con exito!');
        return Redirect::to('ordenservicio/create');
    }


    public function buscar($contrato, $desde, $hasta)
    {
        $ordenservicios = ordenservicios::where('contrato', $contrato)->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)->where('facturado', "0")->get();
        $facturar_tbody = "";
        $facturar_total = 0;
        $count = 0;
        foreach ($ordenservicios as $orden) {
            $facturar_total += $orden->orden_total;
            $total = number_format($orden->orden_total, 2);
            $aseguradora = $orden->aseguradora_id->nombre;
            $facturar_tbody .= "<tr>
          <td class='text-center'><a href='/ordenservicio/$orden->id' name='id[]' target='_blank'>$orden->id</a></td>
          <td>$orden->nombre</td>
          <td>$orden->documento</td>
          <td>$aseguradora</td>
          <td>$orden->created_at</td>
          <td class='text-right'>$total</td> 
          <td class='text-center'>
            <input name='facturar[]' data-value='$orden->orden_total' data-id='$count' type='checkbox' class='form-control facturar'>
            <input type='hidden' name='orden[]' class='orden_id' value='$orden->id'>
           </td>
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
                'error' => 'No se encontraron ordenes de servicios.'
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
        $ordenservicio = ordenservicios::findOrFail($id);
        $OrdenServicio_Items = OrdenServicio_Items::where('id_orden_servicio', $id)->get();
        $factura_item = FacturaItems::select('id_factura')->where('id_orden_servicio', $id)->get();
        $factura = 0;
        if (count($factura_item) > 0) {
            $factura = $factura_item[0]->id_factura;
        }
        $datos = ['ordenservicio' => $ordenservicio, 'OrdenServicio_Items' => $OrdenServicio_Items, 'factura' => $factura];

        return view("orden_servicio.show", $datos);
    }

    public function ordenes_facturar($desde, $hasta)
    {
        $ordenservicios = ordenservicios::where('facturado', "0")
            ->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)
            ->get();
        $tbody_ordenes_facturar = "";

        foreach ($ordenservicios as $orden) {
            $aseguradora = $orden->aseguradora_id->nombre;
            $tbody_ordenes_facturar .= "<tr>
          <td class='text-center'><a href='/ordenservicio/$orden->id' name='id[]' target='_blank'>$orden->id</a></td>
          <td>$orden->documento</td>
          <td>$orden->nombre</td>
          <td>$aseguradora</td>
          <td>$orden->contrato</td>
            <td>$orden->created_at</td>
            <td>&anbsp</td>

           
           </tr>";
        }


        if ($tbody_ordenes_facturar != "") {
            return response()->json([
                'success' => 'true',
                'tbody_ordenes_facturar' => $tbody_ordenes_facturar
            ]);
        } else {
            return response()->json([
                'error' => 'No se encontraron ordenes de servicios por facturar..'
            ]);
        }


    }


}
