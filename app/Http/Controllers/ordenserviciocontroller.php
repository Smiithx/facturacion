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

        // validar datos
        $cups_error = array();
        $servicio_error = array();
        $anular = false;
        for ($i = 0; $i < count($request->cups); $i++) {
            $cup = $request->cups[$i];
            $servicio = \App\Servicios::where("cups",$cup)->get();
            if($servicio == "[]"){
                $cups_error[] = $cup;
            }else{
                $contrato = \App\Contratos::selectRaw("manuales.costo,contratos.porcentaje")
                    ->join("manuales", "contratos.id_manual", "=", "manuales.id")
                    ->join("servicios", "servicios.id", "=", "manuales.servicios_id")
                    ->where("contratos.id", $paciente->id_contrato->id)
                    ->where("contratos.estado", "Activo")
                    ->where("manuales.servicios_id", $servicio[0]->id)
                    ->where("manuales.estado","Activo")
                    ->where("servicios.estado","Activo")
                    ->get();

                if ($contrato == "[]") {
                    $servicio_error[]=$cup;
                }
            }
        }
        $cups_error_message = "";
        $servicio_error_message = "";
        if(count($cups_error) > 0){
            $anular=true;
            if(count($cups_error) > 1){
                $cups_error_message.="Los siguientes códigos cups son incorrectos: ";
            }else{
                $cups_error_message.="El siguiente código cups es incorrecto: ";
            }
            foreach($cups_error as $cups){
                $cups_error_message.= "$cups, ";
            }
        }
        if(count($servicio_error) > 0){
            $anular=true;
            if(count($servicio_error) > 1){
                $servicio_error_message.="Los siguientes códigos cups, no se encuentran disponible para este contrato: ";
            }else{
                $servicio_error_message.="El siguiente código cups,no se encuentran disponible para este contrato: ";
            }
            foreach($servicio_error as $cups){
                $servicio_error_message.= "$cups, ";
            }
        }

        // crear orden de servicio
        if($anular){
            flash(($cups_error_message != '' ?"$cups_error_message<br>": '').$servicio_error_message)->error();
        }else{
            $orden_de_servicio = ordenservicios::create([
                'nombre' => $paciente->nombre,
                'documento' => $paciente->documento,
                'id_paciente' => $paciente->id,
                'aseguradora_id' => $paciente->aseguradora_id->id,
                'id_contrato' => $paciente->id_contrato->id
            ]);
            $orden_total = 0;

            for ($i = 0; $i < count($request->cups); $i++) {
                $cup = $request->cups[$i];
                $servicio = \App\Servicios::where("cups",$cup)->get()[0];
                $contrato = \App\Contratos::selectRaw("manuales.costo,contratos.porcentaje")
                    ->join("manuales", "contratos.id_manual", "=", "manuales.id")
                    ->where("contratos.id", $paciente->id_contrato->id)
                    ->where("manuales.servicios_id", $servicio->id)
                    ->get();
                $precio = $contrato[0]->costo * $contrato[0]->porcentaje / 100.00;
                $total = ((double)$request->cantidad[$i] * $precio) - (double)$request->copago[$i];
                $orden_total += $total;
                OrdenServicio_Items::create([
                    'id_orden_servicio' => $orden_de_servicio->id,
                    'cups' => $cup,
                    'descripcion' => $servicio->descripcion,
                    'cantidad' => (double)$request->cantidad[$i],
                    'copago' => (double)$request->copago[$i], 
                    'valor_unitario' => $precio,
                    'valor_total' => $total,
                    'facturado' => 0
                ]); 
            }
            $orden_de_servicio->orden_total = $orden_total;
            $orden_de_servicio->save();

            flash("La orden <a href='/ordenservicio/$orden_de_servicio->id'>#$orden_de_servicio->id</a> ha sido registrada con éxito!")->success();
        }
        return Redirect::to('/ordenservicio/create');
    }


    public function buscar($contrato, $desde, $hasta)
    {
        $ordenservicios = ordenservicios::where('id_contrato', $contrato)->whereDate('created_at', '>=', $desde)
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
