@extends('reportes.index')
@section('reportes') 
<!-- Inicia reporte 1 -->
<div class="col-sm-12">
     <h3 class="text-center">Total Facturado</h3>

    <form method="POST">
        <div class="form-group col-sm-3">
            <label>Aseguradora</label>
            <select class="form-control aseguradora" name="aseguradora">
                <option value="">Selecciones una Aseguradora</option>
                @foreach ($aseguradoras as $aseguradora)
                <option value="{{$aseguradora->id}}">{{$aseguradora->nombre}}</option>
                @endforeach
                <option value="">Todas</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <label>Contrato</label>
            <select class="form-control contrato" name="contrato">
                <option value="">Seleccione un Contrato</option>
                @foreach ($contratos as $contrato)
                <option value="{{$contrato->id}}">{{$contrato->nombre}}</option>
                @endforeach
                <option value="">Todos</option>
            </select>
        </div>
        
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
        
        <div class="form-group col-sm-12">
            <button type="button" id="resulta_r1" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover" id="tabla_r1">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Fecha expedición</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Valor unitario</th>
                <th class="text-center">Valor total</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <a   class="btn btn-primary btn-lg" href="/reportes/totalfacturado/pdf" target="_blak">Imprimir</a>

</div>

@stop
<!-- Termina reporte 1 -->