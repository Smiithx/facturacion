@extends('reportes.index')
@section('reportes') 
<!-- Inicia reporte 2 -->
<div class="col-sm-12">
        <h3 class="text-center">Facturas Radicadas</h3>

        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input type='text' name="radicacion_fecha_inicio" id="radicacion_fecha_inicio" class="form-control" placeholder="Desde"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>            
        </div>
        
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input type='text' name="radicacion_fecha_fin" id="radicacion_fecha_fin" class="form-control" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
         <label>&nbsp</label>
            <input value="Buscar" type="button" name="btn_radicacion_buscar" id="btn_radicacion_buscar" class="btn-success form-control">
        </div>
 
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_radicacion">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">Ver Factura #</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Fecha</th>
              
            </tr>
        </thead>
        <tbody id="radicacion_tbody">
        

        </tbody>
    </table>
     <a   class="btn btn-primary btn-lg" href="/reportes/Radicacion/pdf" target="_blak">Imprimir</a>
</div>
    <script src="{{asset('assets/js/radicacion.js')}}"></script>

@stop
<!-- Termina reporte 2 -->