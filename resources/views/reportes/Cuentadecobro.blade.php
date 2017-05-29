@extends('reportes.index')
@section('menu')

    @include('reportes.partials.menu',["pagina" => "Cuenta de cobro", "seccion" => "cuenta de cobro"])

@stop

@section('reportes') <!-- Inicia reporte 5 -->
<div class="row">
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Factura:</label>
        <input class="form-control" placeholder="Escibir Factura " id="cxc_factura" type="text" name="id_factura"/>
    </div>

    <div class="form-group col-xs-12 col-md-1">
        <label for=""></label>
        <button class="btn btn-success" id="btn_cxc_buscar" type="button">Buscar</button>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabla_r4">
        <thead>
        <tr>

            <th class="text-center">Nº de Factura</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Documento</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Cups</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Copago</th>
            <th class="text-center">Valor unitario</th>
            <th class="text-center">Valor Total</th>


        </tr>
        </thead>
        <tbody id="cxc_tbody">

        </tbody>
        <tfoot>

        <tr>
            <th colspan="8" class="text-right">Total</th>
            <th class="text-right" colspan="1" id="total_facturado_cxc"></th>
        </tr>
        <tr>
            <th colspan="8" class="text-right">Saldo Pendiente</th>
            <th class="text-right" colspan="1" id="saldo_cxc"></th>
        </tr>

        </tfoot>
    </table>
</div>
<div class="form-group col-xs-12 text-right">
    <a href="#" class="btn btn-primary" id="reporte_cxc_btn_imprimir" target="_blank">Imprimir</a>
</div>

<script src="{{asset('assets/js/cxc.js')}}"></script>

@stop

<!-- Termina reporte 5 -->