<?php

namespace App\Http\Controllers;

use App\Aseguradora;
use App\Contratos;
use App\Empresa;
use App\Factura;
use App\FacturaItems;
use App\ordenservicios;
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
        $empresa = Empresa::findOrFail(1);
        $total_facturado2 = 0;

        $facturas = Factura::selectRaw("facturas.created_at, factura_items.id_factura, ordendeservicio.documento, ordendeservicio.nombre, facturas.factura_total")
            ->join("factura_items", "facturas.id", "=", "factura_items.id_factura")
            ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
            ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio");

        if ($aseguradora != "all") {
            $facturas = $facturas->where('ordendeservicio.aseguradora_id', $aseguradora);
        }

        if ($aseguradora != "all") {
            $facturas = $facturas->where('facturas.id_contrato', $contrato);
        }

        $facturas = $facturas->whereDate('facturas.created_at', '>=', $desde)
            ->whereDate('facturas.created_at', '<=', $hasta)
            ->groupBy('facturas.id')
            ->get();

        foreach ($facturas as $factura) {
            $total_facturado2 += $factura->factura_total;
        }
        $total_facturado = number_format($total_facturado2, 2);


        $pdf = PDF::loadView('reportes.pdf.totalfacturado', compact('facturas', 'empresa', 'total_facturado'))->setPaper('a4', 'landscape');
        //return view("reportes.pdf.totalfacturado",compact('factura','empresa'));
        return $pdf->Stream('totalfacturado.pdf');


    }

    public function Ordenesporfacturar()
    {
        return view("reportes.Ordenesporfacturar");

    }

    public function Ordenesporfacturarpdf($desde, $hasta)
    {
        $ordenes = ordenservicios::where('facturado', "0")
            ->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)
            ->where('anulado', "0")
            ->get();
        $empresa = Empresa::findOrFail(1);
       $pdf = PDF::loadView('reportes.pdf.Ordenesporfacturar', compact("ordenes", "empresa"));
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
        
        $factura = Factura::findOrFail($id);
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
        $pdf = PDF::loadView('reportes.pdf.Imprimirfactura', compact('factura', 'empresa', 'items'))->setPaper('a4');
        return $pdf->Stream('Imprimirfactura.pdf');


    }

    public function Cuentadecobro()
    {
        return view("reportes.Cuentadecobro");

    }

    public function Cuentadecobropdf($id)
    {
                $empresa = Empresa::findOrFail(1);

        $facturas = FacturaItems::selectRaw("ordendeservicio.id, ordendeservicio.created_at, ordendeservicio.documento, ordendeservicio.nombre, orden_servicio_items.cups, orden_servicio_items.descripcion, orden_servicio_items.copago, orden_servicio_items.valor_unitario, orden_servicio_items.valor_total, cartera.valor_saldo")
            ->join("ordendeservicio", "factura_items.id_orden_servicio", "=", "ordendeservicio.id")
            ->join("orden_servicio_items", "ordendeservicio.id", "=", "orden_servicio_items.id_orden_servicio")
            ->join("cartera", "factura_items.id_factura", "=", "cartera.id_factura")
            ->where('factura_items.id_factura', $id)
            ->where('cartera.valor_saldo', '>=', 1)
            ->groupBy('factura_items.id')
            ->get();

            $total_facturado_cxc2 = 0;
            $saldo_cxc2 = 0;


             foreach ($facturas as $factura) {
                 $total_facturado_cxc2 += $factura->valor_total;
                    $saldo_cxc2 = number_format($factura->valor_saldo, 2);
                   }
                $total_facturado_cxc = number_format($total_facturado_cxc2, 2);
                $saldo_cxc = $saldo_cxc2;
            

        $pdf = PDF::loadView('reportes.pdf.Cuentadecobro', compact('facturas', 'empresa', 'total_facturado_cxc', 'saldo_cxc'))->setPaper('a4');
        return $pdf->Stream('Cuentadecobro.pdf');
     

    }

    public function radicacion()
    {
        return view("reportes.Radicacion");

    }

    public function radicacionpdf($desde, $hasta)
    {
        $empresa = Empresa::findOrFail(1);
         $facturasradicadas = Factura::selectRaw("facturas.id,facturas.fecha_radicacion,facturas.factura_total")
            ->where('radicada', 1)
            ->whereDate('fecha_radicacion', '>=', $desde)
            ->whereDate('fecha_radicacion', '<=', $hasta)
            ->get();

$pdf = PDF::loadView('reportes.pdf.radicacion', compact('empresa','facturasradicadas'))->setPaper('a4');
        return $pdf->Stream('radicacion.pdf');

    }
}
