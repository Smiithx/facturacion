@extends('layouts.layout')
@section('content')
<div class="col-sm-12">
     <h3 class="text-center">Cartera</h3>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
             <label for="label">Factura</label>  
             <input class="form-control"  placeholder="Escibir Factura" id="cartera_factura" type="text" name="id_factura"/>
        </div>          
        <div class="form-group col-xs-12 col-md-1">
            <label for="">&nbsp</label>
            <button class="btn btn-success" id="btn_cartera_reporte_buscar" type="button">Buscar</button>
        </div>
        <table style="width:100%;font-size: 15px;" class="table tables-responsive table-striped table-bordered table-hover" id="tabla_r4">
             <thead style="color:#fff; background: #3b5998;">
                <tr>
                    <th class="text-center">Nº Factura</th>
                    <th class="text-center">Total Factura</th>
                    <th class="text-center">Valor Glosas</th>
                    <th class="text-center">Abono inicial</th>
                    <th class="text-center">Valor Abonos</th>
                    <th class="text-center">Valor Retencion</th>
                    <th class="text-center">Saldo</th>                          
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="cartera_tbody">
            </tbody>    
        </table>  
        <br>
        <div class="form-group col-xs-12 text-right">     
        <button class="btn btn-primary " id="reporte_factura_btn_imprimir">Imprimir</button>
        </div>
</div>
<script src="{{asset('assets/js/cartera.js')}}"></script>
@endsection