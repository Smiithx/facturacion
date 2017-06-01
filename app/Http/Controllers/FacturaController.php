<?php

namespace App\Http\Controllers;

use App\Contratos;
use App\Factura;
use App\FacturaItems;
use App\ordenservicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contratos = Contratos::all();
        $datos = ['contratos' => $contratos];
        return View('facturas.create', $datos);
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
            'id_contrato' => 'required',
            'orden' => 'required'
        ]);

        $factura = Factura::create([
            'id_contrato' => $request->id_contrato
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

        flash("La factura <a href='/facturas/$factura->id'><b>#$factura->id</b></a> ha sido registrada con éxito. 
            <a href='/reportes/imprimirfacturas/pdf/$factura->id'>Imprimir</a>"
        )->success();
        return Redirect::to('facturas/create');

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
                if ($factura->anulado != 1) {
                    $radicacion_tbody = "<tr>
                        <td class=\"text-center\">
                            <a href=\"/facturas/$factura->id\" target='_blank'>$factura->id</a>
                         </td>
                        <td>" . $factura->id_contrato->nombre . "</td>
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
                }else{
                    return response()->json([
                        'error' => 'Factura anulada.'
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
            $datos = ['factura' => $factura, 'ordenes' => $FacturaItems];
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
        $facturas = Factura::where("radicada", 0)
            ->where('id_contrato', $contrato)
            ->where('anulado', 0)
            ->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)
            ->get();

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
            $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre", "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')->get();

            $totalfacturado_tbody = "";
            $total_facturado2 = 0;

            foreach ($facturas as $factura) {
                $total_facturado2 += $factura->factura_total;

                $totalfacturado_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id_factura' target='_blank'>$factura->id_factura</a></td> 
          <td class='text-center'>$factura->created_at</td>
          <td>$factura->documento</td>
          <td>$factura->nombre</td>
          <td class='text-right'>" . number_format($factura->factura_total, 2) . "</td>          
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
                ->where('facturas.id_contrato', $contrato)
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
            $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre", "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->where('facturas.id_contrato', $contrato)
                ->where('ordendeservicio.aseguradora_id', $aseguradora)
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')->get();

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

    public function reporteFactura()
    {
        return View('facturas.reportes.factura');
    }

    public function reporteFacturaShow($id)
    {

        try {
            $factura = Factura::findOrFail($id);

            $factura_items = FacturaItems::selectRaw("orden_servicio_items.cups, orden_servicio_items.descripcion,
            orden_servicio_items.valor_unitario,sum(orden_servicio_items.cantidad) cantidad, sum(orden_servicio_items.copago) copago
            , sum(orden_servicio_items.valor_total) valor_total")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->where("factura_items.id_factura", $id)
                ->groupBy('orden_servicio_items.cups', "orden_servicio_items.descripcion", "orden_servicio_items.valor_unitario")
                ->orderBy('orden_servicio_items.cups', 'asc')
                ->get();

            if (is_null($factura)) {
                return response()->json([
                    'error' => 'Numero de factura desconocido.'
                ]);
            } else {
                return response()->json([
                    'success' => 'true',
                    'factura_items' => $factura_items,
                    'factura' => $factura
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Numero de factura desconocido.'
            ], 200);
        }
    }

    public function reporteContrato()
    {
        $contratos = Contratos::all();
        $datos = ['contratos' => $contratos];
        return View('facturas.reportes.contrato', $datos);
    }

    public function reporteContratoShow($contrato, $desde, $hasta)
    {
        try {
            $facturas = Factura::where("id_contrato", $contrato)
                ->whereDate('created_at', '>=', $desde)
                ->whereDate('created_at', '<=', $hasta)->get();

            if ($facturas != "[]") {
                return response()->json([
                    'success' => 'true',
                    'facturas' => $facturas,
                ]);
            } else {
                return response()->json([
                    'error' => 'No se encontraron facturas asociadas a este contrato dentro del rango de fechas seleccionadas.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se encontraron facturas asociadas a este contrato dentro del rango de fechas seleccionadas.'
            ], 200);
        }
    }

    //---------------- reporte  Imprimir Facturas-------------------------------//
    public function imprimir($anulado, $desde, $hasta)
    {

        $facturas = FacturaItems::select("factura_items.id_factura", "factura_items.id_orden_servicio")
            ->join("facturas", "facturas.id", "=", "factura_items.id_factura")
            ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
            ->where('facturas.anulado', $anulado)
            ->whereDate('facturas.created_at', '>=', $desde)
            ->whereDate('facturas.created_at', '<=', $hasta)
            ->groupBy("factura_items.id_factura")
            ->get();

        $imprimirfactura_tbody = "";

        foreach ($facturas as $factura) {


            $imprimirfactura_tbody .= "<tr> 
                    <td class='text-center'><a href='/facturas/" . $factura->id_factura->id . "' target='_blank'>" . $factura->id_factura->id . "</a></td>
                    <td>" . $factura->id_orden_servicio->documento . "</td>
                    <td>" . $factura->id_orden_servicio->nombre . "</td>
                    <td>" . $factura->id_orden_servicio->aseguradora_id->nombre . "</td>
                    <td>" . $factura->id_orden_servicio->id_contrato->nombre . "</td>
                    <td>" . $factura->id_factura->created_at . "</td>
                     <td class='acciones'>
                  <a href='/facturas/" . $factura->id_factura->id . "/anular' class='btn btn-danger' data-toggle='tooltip' title='Anular'>
                    <i class='glyphicon glyphicon-remove'></i>
                   </a>
                    <a href='/reportes/imprimirfacturas/pdf/" . $factura->id_factura->id . "' target='_blank' class='btn btn-success' data-toggle='tooltip' title='Imprimir'>
                    <i class='glyphicon glyphicon-print'></i>
                   </a>                 
                    </td>
                    </tr>";

        }

        if ($imprimirfactura_tbody != "") {
            return response()->json([
                'success' => 'true',
                'facturas' => $facturas,
                'imprimirfactura_tbody' => $imprimirfactura_tbody

            ]);
        } else {
            return response()->json([
                'error' => 'No se encontro factura.'
            ]);
        }
    }

    //----------------- Anular Factura---------------------------//
    public function anular($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->anulado = 1;
        $factura->radicada = 0;
        $factura->fecha_radicacion = "";

        $factura->save();
        $factura_items = FacturaItems::where('id_factura', $factura->id)->get();

        foreach ($factura_items as $item) {
            $ordene = $item->id_orden_servicio;
            $ordene->anulado = 1;
            $ordene->save();
        }
        flash("La factura <b>#$id</b> ha sido anulada con éxito.");
        return Redirect::to('/reportes/Imprimirfactura');

    }


//----------------- reporte cuenta por cobrar---------------------------//
    public function cxcbuscar($factura)
    {
        $facturas = FacturaItems::select("ordendeservicio.id", "ordendeservicio.created_at", "ordendeservicio.documento", "ordendeservicio.nombre", "orden_servicio_items.cups", "orden_servicio_items.descripcion", "orden_servicio_items.copago", "orden_servicio_items.valor_unitario", "orden_servicio_items.valor_total", "cartera.valor_saldo")
            ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
            ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
            ->join("cartera", "factura_items.id_factura", "=", "cartera.id_factura")
            ->where('factura_items.id_factura', $factura)
            ->where('cartera.valor_saldo', '>=', 1)
            ->groupBy('factura_items.id')
            ->get();

        $cxc_tbody = "";
        $total_facturado_cxc = 0;
        $saldo_cxc = 0;


        foreach ($facturas as $factura) {
            $total_facturado_cxc += $factura->valor_total;
            $saldo_cxc = number_format($factura->valor_saldo, 2);
            $cxc_tbody .= "<tr> 
          <td class='text-center'><a href='/ordenservicio/$factura->id' target='_blank'>$factura->id</a></td>
          <td>$factura->created_at</td>
          <td>$factura->documento</td>
          <td>$factura->nombre</td>
          <td>$factura->cups</td>
          <td>$factura->descripcion</td>
          <td>" . number_format($factura->copago, 3) . "</td>
          <td>" . number_format($factura->valor_unitario, 2) . "</td>
          <td>" . number_format($factura->valor_total, 2) . "</td>
          </tr>";
        }

        if ($cxc_tbody != "") {
            return response()->json([
                'success' => 'true',
                'cxc_tbody' => $cxc_tbody,
                'total_facturado_cxc' => $total_facturado_cxc,
                'saldo_cxc' => $saldo_cxc

            ]);
        } else {
            return response()->json([
                'error' => 'No se encontro factura con saldo pendiente. '
            ]);
        }
    }

}

