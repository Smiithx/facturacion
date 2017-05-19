<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Cartera;
use App\Glosas;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Abonos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


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

    
   public function editar()
    {
       return view("cartera.cartera");

    }    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cartera.create");
    }


    public function createcontrato()
    {

        return view("cartera.createcontrato");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

    $factura = Factura::find($request->id_factura);
    $glosa = Glosas::where('id_factura',$request->id_factura)->get();
    $deduciones = $request->valor_abono + $request->valor_retencion+$glosa[0]->valor_aceptado;
  
     $total = $factura->factura_total - $deduciones;    
    
      $this->validate($request, [
            'id_factura' => 'required',
            'fecha_vencimiento' => 'required',
            'valor_abono' => 'required|numeric|min:0.01',
            'valor_retencion' => 'required|numeric|min:0.01'           
        ]); 
          
        $cartera = Cartera::create($request->all());  
        $cartera->valor_saldo = $total;
        $cartera->save();  
        flash('cartera creada con exito!');
        return Redirect::to('cartera/create');

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


//===============Funcion para Buscar factura para Reporte cartera==============//

    public function reportebuscar($factura){
                $carteras = Cartera::where('id_factura',$factura)->get();
        if (count($carteras) > 0) {// verificar si existe  la cartera
                $abonos = Abonos::where('id_factura',$factura)->get();
                $facturas = Factura::where('id',$factura)->get();
                $abonostotal = 0;
                if (count($abonos) > 0) { // verificar si existe abonos a la cartera

                    foreach ($abonos as $abono) {//recoremos toda la tabla abonos
                     $abonostotal = $abono->valor_abono + $abonostotal;
                    } 

                    $abonostotal = $abonostotal + $carteras[0]->valor_abono;
                }
                else{

                    $abonostotal = $carteras[0]->valor_abono;  
                }

                    $cartera_tbody = "";
                    foreach ($carteras as $cartera) {
                             $cartera_tbody .= "<tr>
                            <td class='text-center'><a href='/facturas/$cartera->id_factura' target='_blank'>$cartera->id_factura</a></td> 
                            <td>". number_format($facturas[0]->factura_total, 2) ."</td>
                            <td>". number_format($cartera->valor_glosa, 2) ."</td>
                            <td>". number_format($abonostotal, 2) ."</td>
                            <td>". number_format($cartera->valor_retencion, 2) ."</td>
                            <td>". number_format($cartera->valor_saldo, 2) ."</td>

                            <td><a style='float: left;' href='/cartera/$cartera->id/edit' class='btn btn-success' data-toggle='tooltip' title='Editar'><i class='glyphicon glyphicon-edit'></i></a>
                            <a style='right: right;' href='/abonos/create/$cartera->id_factura' class='btn btn-primary' data-toggle='tooltip' title='Abonar'><i class='glyphicon glyphicon-usd'></i></a>

                            </td>
                            </tr>";
                        }
        
                    if ($cartera_tbody != "") {
                        return response()->json([
                        'success' => 'true',
                        'cartera_tbody' => $cartera_tbody
                                            ]);
                    }       
                    
        }
        else {
                            return response()->json([
                             'error' => 'No hay cartera con esa factura']);
                    }              

    }
    //========Fin Reporte cartera============//


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carteras = Cartera::where('id',$id)
        ->get(); 

                $datos = ['carteras' => $carteras];
               return view("cartera.edit",$datos);
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
      
       $this->validate($request,[
             'valor_abono' => 'required',
            'valor_retencion' => 'required'
        ]);
          $carteras = Cartera::findOrFail($request->id);
          $carteras->valor_abono = $request->valor_abono;
          $carteras->valor_retencion = $request->valor_retencion;
            $carteras->save();
            flash('La cartera ha sido actualizada Correctamente!');
        return Redirect::to("/cartera/editar");
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
//=================Funcion para Buscar factura para crear cartera===================//

    public function buscar($factura, $contrato)
    {
    //=================crear cartera por Numeroo Factura =======================//

       if ($factura >= 1) { //si es por factura, verifico que halla factura
                    $facturas = Factura::where('id',$factura)->get();

            if (count($facturas) >= 1) { // si existe factura, verifico que tenga glosa
                $glosas = Glosas::where('id_factura',$facturas[0]->id)->get();

                if (count($glosas) >= 1) { //si hay glosa, verifico que tenga cartera
                         $carteras = Cartera::where('id_factura',$glosas[0]->id_factura)->get();


                    if (count($carteras) <= 0) { //si no hay cartera creo la cartera
                        $Facturas = Factura::select("facturas.id", "contratos.diasvencimiento", "facturas.fecha_radicacion", "facturas.factura_total", "glosas.valor_aceptado")
                        ->join("glosas", "facturas.id", "=", "glosas.id_factura")
                        ->join("contratos", "facturas.id_contrato", "=", "contratos.id")
                        ->where('radicada', 1)
                        ->where('facturas.id', $facturas[0]->id)
                        ->get();
                    $cartera_tbody = "";
                    foreach ($Facturas as $factura) {
                    $fecha = Carbon::createFromFormat('Y-m-d', $factura->fecha_radicacion);
                    $fecha->addDay($factura->diasvencimiento);
                    $date = $fecha->format('Y-m-d');            
                    $cartera_tbody .= "<tr>
                    <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                    <input type='hidden' name='id_factura' value='$factura->id'>
                    <td>$factura->fecha_radicacion</td>
          
                    <td><input id='cartera_factura_total' data-value='$factura->factura_total' required type='text' name='factura_total' readonly
                                    class='form-control' value=".number_format($factura->factura_total, 2)."></td>
                    <td>$date</td>
                    <input type='hidden' name='fecha_vencimiento' value='$date'>

          
                    <td><input id='cartera_valor_abono' step='0.00'  required type='number' name='valor_abono'  class='form-control'></td>
          

                    <td><input id='cartera_glosa' data-value='$factura->valor_aceptado' required type='text' name='valor_glosa' readonly
                                        class='form-control' value=".number_format($factura->valor_aceptado, 2)."></td>
                                   
                    <td><input id='cartera_retencion' step='0.00'  required type='number' name='valor_retencion'    class='form-control'></td>
                     

                    <td class='text-right'><input id='cartera_saldo'step='0.00'  required type='text' name='valor_saldo'    class='form-control'></td>
            
                                     </tr>";
                    }//termina el foreach

                        if ($cartera_tbody != "") {
                             return response()->json([
                            'success' => 'true',
                            'cartera_tbody' => $cartera_tbody
                            ]);
                        }
                      }// terminar  si la facturano tiene cartera
                        else {
                    return response()->json([
                    'error' => 'Verificar #Factura , La Factura ya tiene cartera.'
                    ]);
                    }
        
                 }// terminar  si la factura tiene glosa
                else {
                    return response()->json([
                    'error' => 'Verificar #Factura , La Factura No tiene glosa.'
                    ]);
                    }
        }// terminar  si existe factura
        else {
            return response()->json([
                'error' => 'Verificar #Factura o fechas, La Factura No Existe.'
                ]);
                }
        }

       //======crear cartera por Numeroo contrato ============//

        elseif ($contrato >=1) { 
                 $facturas = Factura::where('id_contrato',$contrato)->get();

            if (count($facturas) >= 1) { // si existe factura, verifico que tenga glosa
                $glosas = Glosas::where('id_factura',$facturas[0]->id)->get();

                if (count($glosas) >= 1) { //si hay glosa, verifico que tenga cartera
                         $carteras = Cartera::where('id_factura',$glosas[0]->id_factura)->get();


                    if (count($carteras) <= 0) { //si no hay cartera creo la cartera
                        $Facturas = Factura::select("facturas.id", "contratos.diasvencimiento", "facturas.fecha_radicacion", "facturas.factura_total", "glosas.valor_aceptado")
                        ->join("glosas", "facturas.id", "=", "glosas.id_factura")
                        ->join("contratos", "facturas.id_contrato", "=", "contratos.id")
                        ->where('radicada', 1)
                        ->where('facturas.id',$facturas[0]->id)
                        ->get();
                    $cartera_tbody = "";
                    foreach ($Facturas as $factura) {
                    $fecha = Carbon::createFromFormat('Y-m-d', $factura->fecha_radicacion);
                    $fecha->addDay($factura->diasvencimiento);
                    $date = $fecha->format('Y-m-d');            
                    $cartera_tbody .= "<tr>
                    <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                    <input type='hidden' name='id_factura' value='$factura->id'>
                    <td>$factura->fecha_radicacion</td>
          
                    <td><input id='cartera_factura_total' data-value='$factura->factura_total' required type='text' name='factura_total' readonly
                                    class='form-control' value=".number_format($factura->factura_total, 2)."></td>
                    <td>$date</td>
                    <input type='hidden' name='fecha_vencimiento' value='$date'>

          
                    <td><input id='cartera_valor_abono' step='0.00'  required type='number' name='valor_abono'  class='form-control'></td>
          

                    <td><input id='cartera_glosa' data-value='$factura->valor_aceptado' required type='text' name='valor_glosa' readonly
                                        class='form-control' value=".number_format($factura->valor_aceptado, 2)."></td>
                                   
                    <td><input id='cartera_retencion' step='0.00'  required type='number' name='valor_retencion'    class='form-control'></td>
                     

                    <td class='text-right'><input id='cartera_saldo'step='0.00'  required type='text' name='valor_saldo'    class='form-control'></td>
            
                                     </tr>";
                    }//termina el foreach

                        if ($cartera_tbody != "") {
                             return response()->json([
                            'success' => 'true',
                            'cartera_tbody' => $cartera_tbody
                            ]);
                        }
                      }// terminar  si la facturano tiene cartera
                        else {
                    return response()->json([
                    'error' => 'Verificar Contrato , La Factura ya tiene cartera.'
                    ]);
                    }
        
                 }// terminar  si la factura tiene glosa
                else {
                    return response()->json([
                    'error' => 'Verificar #Contrato , La Factura No tiene glosa.'
                    ]);
                    }
        }// terminar  si existe factura
        else {
            return response()->json([
                'error' => 'Verificar #Contrato o fechas, La Factura No Existe.'
                ]);
                }

                    
          }//==terminar  cartera por contrato==/

    }//========termina la funcion buscar para cartera====//
}
