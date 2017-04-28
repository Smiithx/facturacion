@extends('layouts.layout')
@section('content')

<h3 class="text-left">Reportes</h3>
<br>

<!-- opciones -->
<div class="col-sm-12">
  <a   class="btn btn-primary btn-lg" href="Reportes/totalfacturado" target="_blak">Total facturado</a></li>

    <button type="button" id="reporte2" class="btn btn-primary btn-lg"">Ordenes por facturar</button>
     <button type="button" id="reporte3" class="btn btn-primary btn-lg"">Atenciones realizadas</button>
     <button type="button" class="btn btn-primary btn-lg"">Imprimir factura</button>
    <button type="button" id="reporte7" class="btn btn-primary btn-lg"">Cuenta de Cobro</button>
</div>
<!-- fin opciones -->



<!-- Inicia reporte 6 -->
<div class="col-sm-12 reporte6 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Documento:</label>
            <input class="form-control" name="documento" placeholder="Documento" id="documento"></input>
        </div>
    <div class="form-group col-md-3">
        <label>Fecha inicio:</label>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' name="inicio6" id="inicio6" class="form-control date" placeholder="Fecha inicio"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Fecha fin:</label>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' name="fin6" id="fin6" class="form-control date" placeholder="Fecha fin"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <button type="button" id="resulta_r6" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
    </div>
    </form>
<table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r6">
    <thead style="color:#fff; background: #3b5998;">
        <tr>
            <th class="text-center">ID</th>
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
</div>
<!-- Termina reporte 6 -->
<!-- Inicia reporte 7 -->
<div class="col-sm-12 reporte7 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Documento:</label>
            <input class="form-control" name="documento" placeholder="Documento" id="documento7"></input>
        </div>
    <div class="form-group col-md-3">
        <label>Fecha inicio:</label>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' name="inicio7" id="inicio7" class="form-control date" placeholder="Fecha inicio"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Fecha fin:</label>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' name="fin7" id="fin7" class="form-control date" placeholder="Fecha fin"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <button type="button" id="resulta_r7" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
    </div>
    </form>
<table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r7">
    <thead style="color:#fff; background: #3b5998;">
        <tr>
            <th class="text-center">ID</th>
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
</div>
<!-- Termina reporte 7 -->
<!-- Inicia reporte 8 -->
<div class="col-sm-12 reporte8 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Documento:</label>
            <input class="form-control" name="documento" placeholder="Documento" id="documento8"></input>
        </div>
    <div class="form-group col-md-3">
        <label>Fecha inicio:</label>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' name="inicio8" id="inicio8" class="form-control date" placeholder="Fecha inicio"/>
            <span class="input-group-addon"></span>
        </div>
    </div>
</div>
@endsection