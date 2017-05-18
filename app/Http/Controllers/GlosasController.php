<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Glosas;
use App\Contratos;
use App\Factura;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GlosasController extends Controller
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
        return view("glosas.create");
    }

  public function createcontrato()           
    {
      $contratos = Contratos::where('estado', 'Activo')->get();
             $contratoss = ['contratos' => $contratos];
      return view("glosas.createcontrato",compact('contratos'));
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    $glosas = Glosas::select("facturas.factura_total","glosas.id","glosas.id_factura","glosas.valor_glosa","glosas.valor_aceptado","glosas.created_at")
        ->join("facturas", "glosas.id_factura", "=", "facturas.id")
        ->where('glosas.id',$id)
        ->get(); 

                $datos = ['glosas' => $glosas];
               return view("glosas.edit",$datos);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       $this->validate($request,[
             'valor_glosa' => 'required',
            'valor_aceptado' => 'required'
        ]);
          $glosas = Glosas::findOrFail($request->id);
          $glosas->valor_glosa = $request->valor_glosa;
          $glosas->valor_aceptado = $request->valor_aceptado;
            $glosas->save();
            flash('La Glosa ha sido actualizada Correctamente!');
        return Redirect::to("/reportes/glosas");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
//===============Funcion para Buscar factura para Reporte glosa==============//

    public function reportebuscar($factura){
                $glosas = Glosas::where('id_factura',$factura)
                                       ->get();
                     $glosas_tbody = "";
                    foreach ($glosas as $glosa) {
                             $glosas_tbody .= "<tr>
                            <td class='text-center'><a href='/facturas/$glosa->id_factura' target='_blank'>$glosa->id_factura</a></td> 
                            <td>". number_format($glosa->valor_glosa, 2) ."</td>
                            <td>". number_format($glosa->valor_aceptado, 2) ."</td>
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
                    }       
                    else {
                            return response()->json([
                             'error' => 'No hay glosa con esa factura']);
                    }              

    }

//=======================Funcion para Buscar factura para crear glosa===================//
 public function buscar($factura, $contrato){  

        //=================crear glosa por Numeroo Factura =======================//

        if ($factura >= 1) { //si esta instanciado el input id_factura
                    $facturas = Factura::where('id',$factura)
                     ->get();
            if (count($facturas) >= 1) { // verificar si existe factura
                 $facturas = Factura::where('id',$factura)
                 ->where('radicada',1)->get();
                if (count($facturas) >= 1) { // verificar si la factura esta radicada 
                            $glosas = Glosas::where('id_factura',$facturas[0]->id)->get();
                    if (count($glosas) <= 0) { // si la factura radicada ya tiene glosa        
                        $glosas_tbody = "";           
                        foreach ($facturas as $factura) {
                             $glosas_tbody .= "<tr>
                            <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                            <input type='hidden'  name='id_factura' value='$factura->id'>
                            <td>$factura->fecha_radicacion</td>
                            <td>". number_format($factura->factura_total, 2) ."</td>
                            <td><input style='width: 100%;' type='number' step='0.00' placeholder='Ingresar valor'  class='form-control'     name='valor_glosa' required></td>
                            <td><input style='width: 100%;' type='number' step='0.00' placeholder='Ingresar valor' class='form-control' name='valor_aceptado' required></td>
                            </tr>";
                        }

                        if ($facturas != "") {
                            return response()->json([
                             'success' => 'true',
                                'glosas_tbody' => $glosas_tbody
                            ]);
                        }       
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
            } // cierra el if de verificar si existe la factura
            else {
                 return response()->json([
                    'error' => 'Verificar Numero deFactura, La Factura No Existe.'
                ]);
                }

        }
    //======================crear glosa por contrato================================//
    elseif ($contrato >=1) {                     
            $facturas = Factura::where('id_contrato',$contrato)
          ->get();
        if (count($facturas) >= 1) { // verificar si existe factura
            $facturas = Factura::where('id_contrato',$contrato)
            ->where('radicada',1)
           ->get();

            if (count($facturas) >= 1) { // verificar si la factura esta radicada 
                $glosas = Glosas::where('id_factura',$facturas[0]->id)->get();
                if (count($glosas) <= 0) { // si la factura radicada ya tiene glosa
                     $glosas_tbody = "";           
                    foreach ($facturas as $factura) {
                        $glosas_tbody .= "<tr>
                       <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                       <input type='hidden'  name='id_factura' value='$factura->id'>
                        <td>$factura->fecha_radicacion</td>
                        <td>". number_format($factura->factura_total, 2) ."</td>
                        <td><input style='width: 100%;' type='number' step='0.00' placeholder='Ingresar valor' name='valor_glosa' class='form-control' required></td>
                        <td><input style='width: 100%;' type='number' step='0.00' placeholder='Ingresar valor' class='form-control' name='valor_aceptado' required></td>
                        </tr>";
                    }
                    if ($facturas != "") {
                        return response()->json([
                        'success' => 'true',
                         'glosas_tbody' => $glosas_tbody
                        ]);
                    }
                } // cierra el if si la factura radicada tiene glosa
                else {
                    return response()->json([
                    'error' => 'Ya esta factura se le creo la glosa.'
                    ]);
                    }  
            } // cierra el if de verificar si esta radicada la factura
            else {
                return response()->json([
                    'error' => 'Verificar Contrato, Factura No Esta Radicada.'
                ]);
                }
        } // cierra el if de verificar si existe la factura
        else {
            return response()->json([
                    'error' => 'Verificar Contrato, Factura No Existe.'
              ]);
                }
    }// fin de crear glosa por contrato
}//=======Fin de Funcion para Buscar factura para crear glosa==//

}
