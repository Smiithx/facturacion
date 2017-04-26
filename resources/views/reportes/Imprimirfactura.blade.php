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