@extends('layouts.layout')
@section('content')

<h3 class="text-left">Reportes</h3>
<br>

<!-- opciones -->
<div class="col-sm-12">
    <button type="button" id="reporte1" class="btn btn-primary">Total facturado</button>
    <button type="button" id="reporte2" class="btn btn-primary">Ordenes por facturar</button>
    <!-- <button type="button" id="reporte3" class="btn btn-primary">Atenciones realizadas</button> -->
    <!-- <button type="button" class="btn btn-primary">Imprimir factura</button> -->
    <button type="button" id="reporte7" class="btn btn-primary">Cuenta de Cobro</button>
</div>
<!-- fin opciones -->
<!-- Inicia reporte 1 -->
<div class="col-sm-12 reporte1 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-sm-3">
            <label>Aseguradora</label>
            <select class="form-control aseguradora" name="aseguradora">
                <option></option>
                <option value="">Todas</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <label>Contrato</label>
            <select class="form-control contrato" name="contrato">
                <option></option>
                <option value="">Todos</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="fecha_inicio" id="fecha_inicio" class="form-control date" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="fecha_fin" id="fecha_fin" class="form-control date" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <button type="button" id="resulta_r1" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r1">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Fecha expedición</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Valor unitario</th>
                <th class="text-center">Valor total</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- Termina reporte 1 -->
<!-- Inicia reporte 2 -->
<div class="col-sm-12 reporte2 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="inicio2" id="inicio2" class="form-control date" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="fin2" id="fin2" class="form-control date" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <button type="button" id="resulta_r2" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r2">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">CUPS</th>
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
</div>
<!-- Termina reporte 2 -->
<!-- Inicia reporte 3 -->
<div class="col-sm-12 reporte3 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="inicio3" id="inicio3" class="form-control date" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="fin3" id="fin3" class="form-control date" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <button type="button" id="resulta_r3" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r3">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">CUPS</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Diagnostico 1</th>
                <th class="text-center">Diagnostico 2</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- Termina reporte 3 -->
<!-- Inicia reporte 4 -->
<div class="col-sm-12 reporte4 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="inicio4" id="inicio4" class="form-control date" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="fin4" id="fin4" class="form-control date" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <button type="button" id="resulta_r4" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r4">
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
</div>
<!-- Termina reporte 4 -->
<!-- Inicia reporte 5 -->
<div class="col-sm-12 reporte5 hidden">
    <br>
    <form method="POST">
        <div class="form-group col-md-3">
            <label>Fecha inicio:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="inicio4" id="inicio4" class="form-control date" placeholder="Fecha inicio"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Fecha fin:</label>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="fin4" id="fin4" class="form-control date" placeholder="Fecha fin"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <button type="button" id="resulta_r4" class="btn btn-success pull-right"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>
    <table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r4">
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
</div>
<!-- Termina reporte 5 -->
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