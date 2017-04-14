@extends('layouts.layout')
@section('content')
<br>
<form action="/pacientes"  method="POST" name="frm_reg_paciente" >
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Documento:</label>
        <input type="text" class="form-control" id="documento" name="documento" required/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Tipo:</label>   
        <select class="form-control" id="tipodoc" name="tipo_documento">
            <option value="CC">CC</option>
            <option value="TI">TI</option>
            <option value="RC">RC</option>
            <option value="CE">CE</option>
            <option  value="AS">AS</option>
            <option value="MS">MS</option>
            <option value="PA">PA</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Nombre:</label>  
        <input class="form-control" id="nombre" type="text" name="nombre" required/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Edad:</label>
        <input class="form-control" id="edad" type="number" name="edad" required min="1"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Tipo de Edad:</label>
        <select class="form-control" id="anos" name="tipo_edad">
            <option value="años">Años</option>
            <option value="meses">Meses</option>
            <option value="dias">Días</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Fecha Nacimiento:</label>
        <input class="form-control" id="fechana" type="date" name="fecha_nacimiento" required/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Sexo:</label>
        <select class="form-control" id="sexo"  name="sexo">
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Telefono:</label>
        <input class="form-control" id="telefono" type="text" name="telefono" required/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Dirección:</label>
        <input class="form-control" id="direccion" type="text" name="direccion" required/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Aseguradora:</label>
        <input class="form-control" id="aseguradora" type="text" name="aseguradora" required/> 
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Contrato:</label>
        <input class="form-control" id="acontrato" type="text" name="contrato" required/> 
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Regimen:</label>
        <select class="form-control" id="regimen" name="regimen">
            <option value="1">Contributivo</option>
            <option value="2">Subsidiado</option>
            <option value="3">Vinculado</option>
            <option value="4">Particular</option>
            <option value="5">Otro</option>
            <option value="6">Desplazado Contributivo</option>
            <option value="7">Desplazado Subsidiado</option>
            <option value="8">Desplazado Vinculado</option>
        </select>
    </div>
    <br>
    <div class="form-group col-xs-2 col-md-2 col-lg-2">
        <input class="btn btn-primary form-control text-center" type="submit" name="guardar" value="Guardar" />
    </div>
    {{ csrf_field() }}
    <br>
    <br>
</form>
@endsection