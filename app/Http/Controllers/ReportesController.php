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

    public function reportefacturacionpdf($aseguradora, $contrato, $desde, $hasta)
    {
        $facturas = Factura::select("facturas.created_at", "factura_items.id_factura", "ordendeservicio.documento", "ordendeservicio.nombre", "facturas.factura_total")
                ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
                ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
                ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
                ->where('facturas.id_contrato', $contrato)
                ->where('ordendeservicio.aseguradora_id', $aseguradora)
                ->whereDate('facturas.created_at', '>=', $desde)
                ->whereDate('facturas.created_at', '<=', $hasta)
                ->groupBy('facturas.id')->get();
        $empresa = Empresa::findOrFail(1);
        //dd($facturas);
        /*$view = \View::make('reportes.pdf.totalfacturado', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('totalfacturado');
*/
        //$pdf = PDF::loadView('reportes.pdf.totalfacturado');
        //return $pdf->Stream('totalfacturado',compact('facturas'));
    return view("reportes.pdf.totalfacturado",compact('facturas','empresa'));
    }

    public function Ordenesporfacturar()
    {
        return view("reportes.Ordenesporfacturar");

    }

    public function Ordenesporfacturarpdf($desde,$hasta)
    {
        $ordenes = ordenservicios::where('facturado', "0")
            ->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)
                        ->where('anulado', "0")
            ->get();
        $empresa = Empresa::findOrFail(1);
        return view("reportes.pdf.Ordenesporfacturar",compact("ordenes","empresa"));
       /* $pdf = PDF::loadView('reportes.pdf.Ordenesporfacturar');
          return $pdf->Stream('Ordenesporfacturar');*/

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


       $factura =  Factura::findOrFail($id);
       $empresa = Empresa::findOrFail(1);
        $items = FacturaItems::selectRaw("orden_servicio_items.cups, orden_servicio_items.descripcion,
            orden_servicio_items.valor_unitario,sum(orden_servicio_items.cantidad) cantidad, sum(orden_servicio_items.copago) copago
            , sum(orden_servicio_items.valor_total) valor_total")
            ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
            ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
            ->where("factura_items.id_factura", $id)
            ->groupBy('orden_servicio_items.cups', "orden_servicio_items.descripcion", "orden_servicio_items.valor_unitario")
            ->orderBy('orden_servicio_items.cups', 'asc')
            ->get();
       $pdf = PDF::loadView('reportes.pdf.Imprimirfactura',compact('factura','empresa','items'))->setPaper('a4');
       //return view("reportes.pdf.Imprimirfactura",compact('factura','empresa','items'));
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
