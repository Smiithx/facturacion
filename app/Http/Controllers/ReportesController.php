<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
class ReportesController extends Controller
{


public function reportefacturacion() {
   return view("reportes.totalfacturado");

}
public function Ordenesporfacturar() {
   return view("reportes.Ordenesporfacturar");

}
public function Atencionesrealizadas() {
   return view("reportes.Atencionesrealizadas");

}
public function Imprimirfactura() {
   return view("reportes.Imprimirfactura");

}
public function Cuentadecobro() {
   return view("reportes.Cuentadecobro");

}
    public function reportefacturacionpdf() {
  $pdf = PDF::loadView('reportes.pdf.totalfacturado');
  return $pdf->Stream('pruebapdf');
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
