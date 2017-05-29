<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aseguradora;
use App\Empresa;
use App\Contratos;
use App\Factura;
use App\FacturaItems;
use App\ordenservicios;
use App\OrdenServicio_items;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use PDF;

class ReportesController extends Controller
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
        return Redirect::to('/reportes/totalfacturado');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

  
    public function reportefacturacion()
    {
        $aseguradoras = Aseguradora::where('estado', 'Activo')->get();
        $contratos = Contratos::where('estado', 'Activo')->get();
        $contratoss = ['contratos' => $contratos];
        return view('reportes.totalfacturado', compact('contratos', 'aseguradoras'));
    }

    public function reportefacturacionpdf()
    {
        $data = [
            'quantity' => '1',
            'description' => 'some ramdom text',
            'price' => '500',
            'total' => '500'
        ];


        $view = \View::make('reportes.pdf.totalfacturado', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('totalfacturado');

        //$pdf = PDF::loadView('reportes.pdf.totalfacturado');
        //return $pdf->Stream('totalfacturado',compact('facturas'));
    }

    public function Ordenesporfacturar()
    {
        return view("reportes.Ordenesporfacturar");

    }

    public function Ordenesporfacturarpdf($id)
    {
      
        $pdf = PDF::loadView('reportes.pdf.Ordenesporfacturar');
          return $pdf->Stream('Ordenesporfacturar');

    }

    public function Atencionesrealizadas()
    {
        return view("reportes.Atencionesrealizadas");

    }

    public function Atencionesrealizadaspdf()
    {
        $pdf = PDF::loadView('reportes.pdf.Atencionesrealizadas');
        return $pdf->Stream('Atencionesrealizadas');
    }

    public function Imprimirfactura()
    {


        return view("reportes.Imprimirfactura");

    }

    public function Imprimirfacturapdf($id)
    {
 /*$facturas = Factura::select("facturas.id","facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "factura_items.id_orden_servicio", "ordendeservicio.aseguradora_id",  "ordendeservicio.id_contrato", "ordendeservicio.nombre","aseguradoras.nombre as aseguradora","contratos.nombre as contrato")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("aseguradoras","ordendeservicio.aseguradora_id","=","aseguradoras.id")
                ->join("contratos","ordendeservicio.id_contrato","=","contratos.id")
                ->where('facturas.id', $id)->get();*/


       $factura =  Factura::find($id);
       $empresa = Empresa::find(1);
       $pdf = PDF::loadView('reportes.pdf.Imprimirfactura',compact('factura','empresa'))->setPaper('a4');
       return view("reportes.pdf.Imprimirfactura",compact('factura','empresa'));
       return $pdf->Stream('Imprimirfactura.pdf');
     

    }

    public function Cuentadecobro()
    {
        return view("reportes.Cuentadecobro");

    }

    public function Cuentadecobropdf()
    {
        $pdf = PDF::loadView('reportes.pdf.Cuentadecobro');
        return $pdf->Stream('Cuentadecobro');

    }

    public function radicacion()
    {
        return view("reportes.Radicacion");

    }

    public function radicacionpdf()
    {
        $pdf = PDF::loadView('reportes.pdf.Radicacion');
        return $pdf->Stream('Radicacion');

    }
}
