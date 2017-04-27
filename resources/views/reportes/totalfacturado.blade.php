 
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
  
</div>
</body>
</html>
<!-- Termina reporte 1 -->