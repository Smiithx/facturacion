@extends('reportes.index')
@section('reportes') <!-- Inicia reporte 5 -->
<div class="col-sm-12">
     <h3 class="text-center">Cuenta de cobro</h3>

    <form method="POST">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date datepicker' id='datetimepicker1'>
                <input type='text' name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>            
        </div>
        
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date datepicker' id='datetimepicker2'>
                <input type='text' name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
         <label>&nbsp</label>
            <input value="Buscar" type="button" id="resulta_r2" class="btn-success form-control">
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r4">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">Fecha</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
     <a   class="btn btn-primary btn-lg" href="/reportes/Cuentadecobro/pdf" target="_blak">Imprimir</a>
</div>
@stop
<!-- Termina reporte 5 -->