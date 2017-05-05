<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aseguradora;
use App\Contratos;
use App\Factura;
use App\FacturaItems;
use App\ordenservicios;
use App\OrdenServicio_items;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
class ReportesController extends Controller
{


public function reportefacturacion() {
    $aseguradoras = Aseguradora::where('estado', 'Activo')->get();
     $contratos = Contratos::where('estado', 'Activo')->get();
             $contratoss = ['contratos' => $contratos];
            return view('reportes.totalfacturado',compact('contratos','aseguradoras'));

}
    
     public function reportefacturacionpdf() {
     $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];

     
$view =  \View::make('reportes.pdf.totalfacturado', compact('data'))->render();
              $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
      return $pdf->stream('totalfacturado');

        //$pdf = PDF::loadView('reportes.pdf.totalfacturado');
        //return $pdf->Stream('totalfacturado',compact('facturas'));
     }
    
public function Ordenesporfacturar() {
   return view("reportes.Ordenesporfacturar");

}

public function Ordenesporfacturarpdf() {
 $pdf = PDF::loadView('reportes.pdf.Ordenesporfacturar');
      return $pdf->Stream('Ordenesporfacturar');

}

public function Atencionesrealizadas() {
   return view("reportes.Atencionesrealizadas");

}

public function Atencionesrealizadaspdf() {
  $pdf = PDF::loadView('reportes.pdf.Atencionesrealizadas');
         return $pdf->Stream('Atencionesrealizadas');
}
public function Imprimirfactura() {
   return view("reportes.Imprimirfactura");

}
public function Imprimirfacturapdf() {
   $pdf = PDF::loadView('reportes.pdf.Imprimirfactura');
         return $pdf->Stream('Imprimirfactura');

}
public function Cuentadecobro() {
   return view("reportes.Cuentadecobro");

}
public function Cuentadecobropdf() {
     $pdf = PDF::loadView('reportes.pdf.Cuentadecobro');
         return $pdf->Stream('Cuentadecobro');

}
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view("reportes.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
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
