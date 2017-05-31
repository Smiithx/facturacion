<?php

namespace App\Http\Controllers;

use App\Abonos;
use App\Cartera;
use App\Contratos;
use App\Factura;
use App\Glosas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GlosasController extends Controller
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
        return view("glosas.create");
    }

    public function createcontrato()
    {
        $contratos = Contratos::where('estado', 'Activo')->get();
        $contratoss = ['contratos' => $contratos];
        return view("glosas.createcontrato", compact('contratos'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //=================================Funcion de crear la glosa=================================// 
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_factura' => 'required|max:255',
            'valor_glosa' => 'required',
            'valor_aceptado' => 'required'
        ]);
        $glosas = Glosas::create($request->all());
        flash('Glosas creada con exito!');
        return Redirect::to("/glosas/create");
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

    public function editar()
    {
        return view("glosas.glosas");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $glosas = Glosas::select("facturas.factura_total", "glosas.id", "glosas.id_factura", "glosas.valor_glosa", "glosas.valor_aceptado", "glosas.created_at")
            ->join("facturas", "glosas.id_factura", "=", "facturas.id")
            ->where('glosas.id', $id)
            ->get();

        $datos = ['glosas' => $glosas];
        return view("glosas.edit", $datos);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'valor_glosa' => 'required',
            'valor_aceptado' => 'required'
        ]);//validamos que vengan los campos

        $glosas = Glosas::findOrFail($request->id);//buscamo la glosa
        $glosas->valor_glosa = $request->valor_glosa;
        $glosas->valor_aceptado = $request->valor_aceptado;
        $glosas->save();

        $carteras = Cartera::where('id_factura', $glosas->id_factura)->get();//buscamo la cartera para actualizar el valor_saldo
        if (count($carteras) >= 1) { // verificar si existe cartera

            $carteras = Cartera::findOrFail($carteras[0]->id);//buscamos la cartera
            $factura = Factura::find($glosas->id_factura);//buscamos la factura
            $abonos = Abonos::where('id_factura', $glosas->id_factura)->where('anulado', 0)->get();//buscamos abonos con la factura
            $abonostotal = 0;
            if (count($abonos) > 0) { // verificar si existe abonos a la cartera

                foreach ($abonos as $abono) {//recoremos toda la tabla abonos
                    $abonostotal = $abono->valor_abono + $abonostotal;
                }

                $saldo = $factura->factura_total - ($request->valor_aceptado + $carteras->valor_retencion + $carteras->valor_abono + $abonostotal);//calculadmos el saldo en cartera
            } else {

                $saldo = $factura->factura_total - ($request->valor_aceptado + $carteras->valor_retencion + $carteras->valor_abono);
            }

            $carteras->valor_glosa = $request->valor_aceptado;//actualizamos el valor glosa en cartera
            $carteras->valor_saldo = $saldo;//actualizamos el saldo en cartera
            $carteras->save();
            flash('La Glosa ha sido actualizada Correctamente!');
            return Redirect::to("/glosas/editar");
        } else {
            flash('La Glosa ha sido actualizada Correctamente!');
            return Redirect::to("/glosas/editar");
        }
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

    //===============Funcion para Buscar factura para Reporte glosa==============//

    public function reportebuscar($factura)
    {
        $glosas = Glosas::where('id_factura', $factura)
            ->get();
        $glosas_tbody = "";
        foreach ($glosas as $glosa) {
            $glosas_tbody .= "<tr>
                            <td class='text-center'><a href='/facturas/$glosa->id_factura' target='_blank'>$glosa->id_factura</a></td> 
                            <td>" . number_format($glosa->valor_glosa, 2) . "</td>
                            <td>" . number_format($glosa->valor_aceptado, 2) . "</td>
                            <td>$glosa->created_at</td>
                            <td><a style='float: left;' href='/glosas/$glosa->id/edit' class='btn btn-success' data-toggle='tooltip' title='Editar'><i class='glyphicon glyphicon-edit'></i></a>
                            </td>
                            </tr>";
        }

        if ($glosas_tbody != "") {
            return response()->json([
                'success' => 'true',
                'glosas_tbody' => $glosas_tbody
            ]);
        } else {
            return response()->json([
                'error' => 'No hay glosa con esa factura']);
        }

    }

    //=======================Funcion para Buscar factura para crear glosa===================//
    public function buscar($factura, $contrato)
    {

        //=================crear glosa por Numeroo Factura =======================//

        if ($factura >= 1) { //si esta instanciado el input id_factura

            $factura = Factura::find($factura);

            if ($factura->anulado == 1) { // verificar si existe factura

                if ($factura->radicada == 1) { // verificar si la factura esta radicada

                    $glosas = Glosas::where('id_factura', $factura->id)->get();

                    if (count($glosas) <= 0) { // si la factura radicada ya tiene glosa
                        //
                        $glosas_tbody = "<tr>
                            <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                            <input type='hidden'  name='id_factura' value='$factura->id'>
                            <td>$factura->fecha_radicacion</td>
                            <td>" . number_format($factura->factura_total, 2) . "</td>
                            <td><input type='number' step='0.01' placeholder='Ingresar valor'  class='form-control'     name='valor_glosa' required></td>
                            <td><input type='number' step='0.01' placeholder='Ingresar valor' class='form-control' name='valor_aceptado' required></td>
                            </tr>";

                        return response()->json([
                            'success' => 'true',
                            'glosas_tbody' => $glosas_tbody
                        ]);
                    } // cierra el if si la factura radicada tiene glosa
                    else {
                        return response()->json([
                            'error' => 'Ya esta factura se le creo la glosa.'
                        ]);
                    }
                } // cierra el if de verificar si esta radicada la factura
                else {
                    return response()->json([
                        'error' => 'Verificar Factura, No Esta Radicada.'
                    ]);
                }
                // cierra el if de verificar si existe la factura
            } else {
                return response()->json([
                    'error' => 'La factura se encuentra anulada.'
                ]);
            }

        } //======================crear glosa por contrato================================//
        elseif ($contrato >= 1) {
            $facturas = Factura::where('id_contrato', $contrato)
                ->where('anulado', 0)
                ->where('radicada', 1)
                ->get();

            if (count($facturas) >= 1) { // verificar si la factura esta radicada
                $glosas_tbody = "";
                foreach ($facturas as $factura) {
                    $glosas = Glosas::where('id_factura', $factura->id)->get();
                    if (count($glosas) == 0) { // si la factura radicada ya tiene glosa
                        $glosas_tbody .= "<tr>
                       <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                       <input type='hidden'  name='id_factura' value='$factura->id'>
                        <td>$factura->fecha_radicacion</td>
                        <td>" . number_format($factura->factura_total, 2) . "</td>
                        <td><input type='number' step='0.01' placeholder='Ingresar valor' name='valor_glosa' class='form-control' required></td>
                        <td><input type='number' step='0.01' placeholder='Ingresar valor' class='form-control' name='valor_aceptado' required></td>
                        </tr>";
                    }
                }
                if ($glosas_tbody != "") {
                    return response()->json([
                        'success' => 'true',
                        'glosas_tbody' => $glosas_tbody
                    ]);
                }
            } // cierra el if de verificar si esta radicada la factura
            else {
                return response()->json([
                    'error' => 'Verificar Contrato, Factura No Esta Radicada.'
                ]);
            }
        }

    } //=======Fin de Funcion para Buscar factura para crear glosa==//

}
