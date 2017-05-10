@extends('reportes.index')
@section('reportes') 
<!-- Inicia reporte 2 -->
<div class="col-sm-12">
        <h3 class="text-center">Ordenes por Factura</h3>

    <form method="POST">
    
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input  required type='text' name="fecha_inicio" id="fecha_inicio_ordenes_facturar" class="form-control" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>            
        </div>
        
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input required  type='text' name="fecha_fin" id="fecha_fin_ordenes_facturar" class="form-control" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
         <label>&nbsp</label>
            <input value="Buscar" type="button" id="btn_ordenes_facturar_buscar" class="btn-success form-control">
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r2">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">Orden #</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody id="tbody_ordenes_facturar">

        </tbody>
    </table>
     <a   class="btn btn-primary btn-lg" href="/reportes/Ordenesporfacturar/pdf" target="_blak">Imprimir</a>
</div>

    <script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>

@stop
<!-- Termina reporte 2 -->