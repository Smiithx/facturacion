@extends('reportes.index')
@section('reportes') <!-- Inicia reporte 4 -->
<div class="col-sm-12">
        <h3 class="text-center">Imprimir Factura</h3>

    <form method="POST">
      <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input type='text' name="imprimirfactura_fecha_inicio" id="imprimirfactura_fecha_desde" class="form-control" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>            
        </div>
        
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input  type='text' name="imprimirfactura_fecha_fin" id="imprimirfactura_fecha_hasta" class="form-control" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
       

        <div class="form-group col-md-3">
        <label>&nbsp</label><br>
            <button type="button" id="btn_imprimirfactura_buscar" name="btn_imprimirfactura_buscar" class="btn btn-success"><i class="fa fa-search"></i>Buscar</button>
        </div>
</form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r4">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody id="imprimirfactura_tbody">

        </tbody>
    </table>
</div>
    <script src="{{asset('assets/js/factura.js')}}"></script>

@stop
<!-- Termina reporte 4 -->