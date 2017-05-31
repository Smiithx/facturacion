<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Abonos;
use App\Factura;
use App\Cartera;



class AbonosController extends Controller
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
        return view("abonos.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $facturas = Factura::findOrFail($id); 
        return view("abonos.create",compact('facturas'));

    } 


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request,['id_factura'=>'required','descripcion'=>'required','valor_abono'=>'required|numeric|min:0.01' ]);
        $carteras = Cartera::where('id_factura',$request->id_factura)
            ->get();//verifico que si ya la factura tiene cartera.

        if (count($carteras) >= 1) {          // si encuentra cartera

            if($carteras[0]->valor_saldo > 0){ //si el saldo es mayor que 0

                $abonos = Abonos::create($request->all());// creo el abono
                $carteras = Cartera::where('id_factura',$request->id_factura)->get();//busco la cartera para actualizar el monto
                $saldo = $carteras[0]->valor_saldo - $request->valor_abono;//le resto al saldo de factura el valor del abono
                $carteras = Cartera::findOrFail($carteras[0]->id);//buscamo la cartera para actualizar
                $carteras->valor_saldo = $saldo;
                $carteras->save();                 

                flash('Abono fue creado con exito!');
                return Redirect::to('cartera/editar');
            }
            else{ //El saldo es igual que 0
                flash('la factura no tiene saldo pendiente!')->error();
                return Redirect::to('cartera/editar');
            }
        }
        else{ //si no encuentro cartera envio un mensaje

            flash('la factura no tiene cartera!')->error();
            return Redirect::to('cartera/editar');
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $abonos = Abonos::findOrFail($id);  
        $abonos = Abonos::where('id_factura',$id)->where('anulado',0)->get();
        $abonos_tbody = "";

            foreach ($abonos as $abono) {
                $abonos_tbody .= "<tr>
                            <td class='text-center'><a href='/facturas/$abono->id_factura' target='_blank'>$abono->id_factura</a></td> 
                            <td>$abono->descripcion</td>
                            <td>". number_format($abono->valor_abono, 2) ."</td>
                            <td>$abono->created_at</td>
                            <td><a style='float: left;' href='/abonos/$abono->id/edit' class='btn btn-success' data-toggle='tooltip' title='Editar'><i class='glyphicon glyphicon-edit'></i></a>

                            
                                <a href='abonos/$abono->id/anular' class='btn btn-danger' data-toggle='tooltip' title='Eliminar'>
                                <i class='glyphicon glyphicon-remove'></i></a>


                            </td>
                            </tr>";                            
            }

            if ($abonos_tbody != "") {
                     return response()->json([
                     'success' => 'true',
                     'abonos_tbody' => $abonos_tbody
                     ]);
            }       
            else {
                return response()->json([
                'error' => 'No hay abonos a esa factura']);
             }           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $abonos = Abonos::findOrFail($id); 
        return view("abonos.edit",compact('abonos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $abonos = Abonos::findOrFail($id);      
       $carteras = Cartera::where('id_factura',$request->id_factura)->where('anulado',0)->get();
       $saldo = $carteras[0]->valor_saldo; //saco el saldo actual
            if($saldo >=1 ){                
                 $saldo_sin_abono = $saldo + $abonos->valor_abono;//le sumo el valor de abono viejo
                 $saldo_con_abono = $saldo_sin_abono - $request->valor_abono;//le resto el valor de abono nuevo                 

                    $carteras = Cartera::findOrFail($carteras[0]->id);
                    $carteras->valor_saldo = $saldo_con_abono;//actualizamos el saldo
                    $carteras->save();

                    $abonos->fill($request->all());//actualizamos el abono
                    $abonos->save();
                    flash('El abono ha sido actualizado con Exito');
                    return Redirect::to("/abonos");
            }
            else{
                flash('Ya esta factura fue cancelada, Verifique!')->error();
                return Redirect::to("/abonos");
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
    }
    public function anular($id)
    {   
        $abonos = Abonos::findOrFail($id);


       $carteras = Cartera::where('id_factura',$abonos->id_factura)->get();
       $saldo = $carteras[0]->valor_saldo; //saco el saldo actual
            if($saldo >=1 ){                
                 $saldo_sin_abono = $saldo + $abonos->valor_abono;//le sumo el valor de abono viejo
                             

                    $carteras = Cartera::findOrFail($carteras[0]->id);
                    $carteras->valor_saldo = $saldo_sin_abono;//actualizamos el saldo
                    $carteras->save();

                    $abonos->anulado = 1;
                    $abonos->save();
                    flash('El abono ha sido anulado con  Exito')->error();
                    return Redirect::to("/abonos");
            }
            else{
                flash('Ya esta factura fue cancelada, Verifique!')->error();
                return Redirect::to("/abonos");
            }


    }
}
