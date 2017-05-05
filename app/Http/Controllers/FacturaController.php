<?php

namespace App\Http\Controllers;

use App\FacturaItems;
use App\ordenservicios;
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
            }  catch (\Exception $e) {
                return response()->json([
                    'error' => 'Numero de factura desconocido.'
                ],200);
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

    public function buscar($aseguradora, $contrato, $desde, $hasta)
    {
        $facturas = Factura::where('contrato', $contrato)->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)->get();
        foreach ($facturas as $FacturaItem) {
            $facturasitem = FacturaItems::where('id_Factura', $FacturaItem->id);
        }
    }
    public function radicar($contrato, $desde, $hasta)
    {
        $facturas = Factura::where("radicada",0)->where('contrato', $contrato)->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)->get();

        if(count($facturas) > 0){
            return response()->json([
                'success' => true,
                'facturas' => $facturas
            ]);
        }else{
            return response()->json([
                'error' => "No se encontraron facturas pendientes por radicar."
            ]);
        }
    }
}
