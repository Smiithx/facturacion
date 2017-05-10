<?php

namespace App\Http\Controllers;

use App\FacturaItems;
use App\ordenservicios;
use App\OrdenServicio_items;
use App\Paciente;
use Illuminate\Http\Request;
use App\Factura;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pacientes = Paciente::name($request->get('name'))->orderBy('id', 'DES')->paginate();
        return View('facturas.index', ['pacientes' => $pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('facturas.create');
        //
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
            'contrato' => 'required',
            'orden' => 'required'
        ]);

        $factura = Factura::create([
            'contrato' => $request->contrato
        ]);

        $total = 0;
        foreach ($request->orden as $id) {
            $orden = ordenservicios::find($id);
            FacturaItems::create([
                'id_factura' => $factura->id,
                'id_orden_servicio' => $orden->id,
            ]);

            $orden->facturado = 1;
            $orden->save();

            $total += $orden->orden_total;
        }

        $factura->factura_total = $total;
        $factura->save();

        return View('facturas.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            try {
                $factura = Factura::findOrFail($id);// lo trae como objeto
                $radicacion_tbody = "<tr>
                        <td class=\"text-center\">
                            <a href=\"/facturas/$factura->id\" target='_blank'>$factura->id</a>
                         </td>
                        <td>$factura->contrato</td>
                        <td>$factura->created_at</td>
                        <td class=\"text-right\">" . number_format($factura->factura_total, 2) . "</td>
                    </tr>";

                if (is_null($factura)) {
                    return response()->json([
                        'error' => 'Numero de factura desconocido.'
                    ]);
                } else {
                    return response()->json([
                        'success' => 'true',
                        'factura' => $factura,
                        'radicacion_factura_tbody' => $radicacion_tbody
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Numero de factura desconocido.'
                ], 200);
            }
        } else {
            $factura = Factura::findOrFail($id);// lo trae como objeto
            $FacturaItems = FacturaItems::where('id_factura', $id)->get();
            $ordenes = array();
            foreach ($FacturaItems as $item) {
                $ordenservicios = ordenservicios::find($item->id_orden_servicio);
                $ordenes[] = $ordenservicios;
            }
            $datos = ['factura' => $factura, 'ordenes' => $ordenes];
            return View("facturas.show", $datos);

        }
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

    public function radicar($contrato, $desde, $hasta)
    {
        $facturas = Factura::where("radicada", 0)->where('contrato', $contrato)->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)->get();

        if (count($facturas) > 0) {
            return response()->json([
                'success' => true,
                'facturas' => $facturas
            ]);
        } else {
            return response()->json([
                'error' => "No se encontraron facturas pendientes por radicar."
            ]);
        }
    }


    public function buscar($aseguradora, $contrato, $desde, $hasta)
    {
        //inicio de traer todo las aseguradoras y todos los contratos
        if ($aseguradora == "all" and $contrato == "all") {
            $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre",  "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')

                ->get();

            $totalfacturado_tbody = "";
            $total_facturado2 = 0;

            foreach ($facturas as $factura) {
                $total_facturado2 += $factura->factura_total;

                $totalfacturado_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id_factura' target='_blank'>$factura->id_factura</a></td> 
          <td>$factura->created_at</td>
          <td>$factura->documento</td>
          <td>$factura->nombre</td>
          <td>" . number_format($factura->factura_total, 2) . "</td>          
           </tr>";
            }

            $total_facturado = number_format($total_facturado2, 2);
            if ($totalfacturado_tbody != "") {
                return response()->json([
                    'success' => 'true',
                    'totalfacturado_tbody' => $totalfacturado_tbody,
                    'total_facturado' => $total_facturado
                ]);
            } else {
                return response()->json([
                    'error' => 'No se encontraron facturas.'
                ]);
            }
        }

        //inicio de traer todo las aseguradoras
        if ($aseguradora == "all" and $contrato !== "all") {
            $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre", "orden_servicio_items.valor_unitario", "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->where('facturas.contrato', $contrato)
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')

                ->get();

            $totalfacturado_tbody = "";
            $total_facturado2 = 0;

            foreach ($facturas as $factura) {
                $total_facturado2 += $factura->factura_total;

                $totalfacturado_tbody .= "<tr> voy al baño ya ba jaja
         <td class='text-center'><a href='/facturas/$factura->id_factura' target='_blank'>$factura->id_factura</a></td> 
          <td>$factura->created_at</td>
          <td>$factura->documento</td>
          <td>$factura->nombre</td>
          <td>" . number_format($factura->factura_total, 2) . "</td>          
           </tr>";

            }

            $total_facturado = number_format($total_facturado2, 2);
            if ($totalfacturado_tbody != "") {
                return response()->json([
                    'success' => 'true',
                    'totalfacturado_tbody' => $totalfacturado_tbody,
                    'total_facturado' => $total_facturado
                ]);
            } else {
                return response()->json([
                    'error' => 'No se encontraron facturas.'
                ]);
            }

        } //inicio de traer todo las contrato
        elseif ($contrato == "all" and $aseguradora !== "all") {
            $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre", "orden_servicio_items.valor_unitario", "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->where('ordendeservicio.aseguradora_id', $aseguradora)
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')

                ->get();

            $totalfacturado_tbody = "";
            $total_facturado2 = 0;

            foreach ($facturas as $factura) {
                $total_facturado2 += $factura->factura_total;

                $totalfacturado_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id_factura' target='_blank'>$factura->id_factura</a></td> 
          <td>$factura->created_at</td>
          <td>$factura->documento</td>
          <td>$factura->nombre</td>
          <td>" . number_format($factura->factura_total, 2) . "</td>          
           </tr>";

            }

            $total_facturado = number_format($total_facturado2, 2);
            if ($totalfacturado_tbody != "") {
                return response()->json([
                    'success' => 'true',
                    'totalfacturado_tbody' => $totalfacturado_tbody,
                    'total_facturado' => $total_facturado
                ]);
            } else {
                return response()->json([
                    'error' => 'No se encontraron facturas.'
                ]);
            }

        }

        //inicio de traer todo con los parametros

        if ($contrato !== "all" and $aseguradora !== "all") {
            $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre",  "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->where('facturas.contrato', $contrato)
                ->where('ordendeservicio.aseguradora_id', $aseguradora)
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')

                ->get();

            $totalfacturado_tbody = "";
            $total_facturado2 = 0;

            foreach ($facturas as $factura) {
                $total_facturado2 += $factura->factura_total;

                $totalfacturado_tbody .= "<tr> 
         <td class='text-center'><a href='/facturas/$factura->id_factura' target='_blank'>$factura->id_factura</a></td> 
          <td>$factura->created_at</td>
          <td>$factura->documento</td>
          <td>$factura->nombre</td>
          <td>" . number_format($factura->factura_total, 2) . "</td>          
           </tr>";

            }

            $total_facturado = number_format($total_facturado2, 2);
            if ($totalfacturado_tbody != "") {
                return response()->json([
                    'success' => 'true',
                    'totalfacturado_tbody' => $totalfacturado_tbody,
                    'total_facturado' => $total_facturado
                ]);
            } else {
                return response()->json([
                    'error' => 'No se encontraron facturas.'
                ]);
            }

        }


    }

}
