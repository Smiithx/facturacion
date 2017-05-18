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
   
     public function create($id)
    {


   $facturas = Factura::findOrFail($id);         
                
            return view("abonos.create",compact('facturas'));

                     //  $datos = ['facturas' => $facturas];
        //return view("abonos.create",$datos);
   
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

                if($carteras[0]->valor_saldo >= 1){ //si el saldo es mayor que 0

                     $abonos = Abonos::create($request->all());// creo el abono
                     $carteras = Cartera::where('id_factura',$request->id_factura)->get();//busco la cartera para actualizar el monto
                     $saldo = $carteras[0]->valor_saldo - $request->valor_abono;//le resto al saldo de factura el valor del abono
                     $carteras = Cartera::findOrFail($carteras[0]->id);//buscamo la cartera para actualizar
                     $carteras->valor_saldo = $saldo;
                     $carteras->save();                 

                    flash('Abono fue creado con exito!');
                    return Redirect::to('reportes/carteras');
                }
                else{ //El saldo es igual que 0
                flash('la factura no tiene saldo pendiente!');
                return Redirect::to('reportes/carteras');
                }
            }
        else{ //si no encuentro cartera envio un mensaje

            flash('la factura no tiene cartera!');
            return Redirect::to('reportes/carteras');
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
        //
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
        //
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
}
