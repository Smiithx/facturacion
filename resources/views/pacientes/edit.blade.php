@extends('layouts.layout')
@section('content')
<br>
<form action="/pacientes"  method="POST" name="frm_reg_paciente" >
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Documento:</label>
        <input type="text" class="form-control" id="documento" name="documento" required value="{{$paciente->documento}}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Tipo:</label>   
        <select class="form-control" id="tipodoc" name="tipo_documento">
            <option value="CC" @if ($paciente->tipo_documento === "CC" ) selected @endif>CC</option>
            <option value="TI" @if ($paciente->tipo_documento === "TI" ) selected @endif>TI</option>
            <option value="RC" @if ($paciente->tipo_documento === "RC" ) selected @endif>RC</option>
            <option value="CE" @if ($paciente->tipo_documento === "CE" ) selected @endif>CE</option>
            <option  value="AS" @if ($paciente->tipo_documento === "AS" ) selected @endif>AS</option>
            <option value="MS" @if ($paciente->tipo_documento === "MS" ) selected @endif>MS</option>
            <option value="PA" @if ($paciente->tipo_documento === "PA" ) selected @endif>PA</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Nombre:</label>  
        <input class="form-control" id="nombre" type="text" name="nombre" required value="{{$paciente->nombre}}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Edad:</label>
        <input class="form-control" id="edad" type="number" name="edad" required min="1" value="{{$paciente->edad}}"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Tipo de Edad:</label>
        <select class="form-control" id="anos" name="tipo_edad">
            <option value="Años" @if ($paciente->tipo_edad === "Años" ) selected @endif>Años</option>
            <option value="Meses" @if ($paciente->tipo_edad === "Meses" ) selected @endif>Meses</option>
            <option value="Dias" @if ($paciente->tipo_edad === "Dias" ) selected @endif>Días</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Fecha Nacimiento:</label>
        <input class="form-control datepicker" id="fechana" type="text" name="fecha_nacimiento" placeholder="{{$paciente->fecha_nacimiento}}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Sexo:</label>
        <select class="form-control" id="sexo"  name="sexo">
            <option value="Femenino" @if ($paciente->sexo === "Femenino" ) selected @endif>Femenino</option>
            <option value="Masculino" @if ($paciente->sexo === "Masculino" ) selected @endif>Masculino</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Telefono:</label>
        <input class="form-control" id="telefono" type="text" name="telefono" required value="{{$paciente->telefono}}"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Dirección:</label>
        <input class="form-control" id="direccion" type="text" name="direccion" required value="{{$paciente->direccion}}"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Aseguradora:</label>
        <input class="form-control" id="aseguradora" type="text" name="aseguradora" required value="{{$paciente->aseguradora}}"/> 
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Contrato:</label>
        <input class="form-control" id="acontrato" type="text" name="contrato" required value="{{$paciente->contrato}}"/> 
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Regimen:</label>
        <select class="form-control" id="regimen" name="regimen">
            <option value="Contributivo">Contributivo</option>
            <option value="Subsidiado">Subsidiado</option>
            <option value="Vinculado">Vinculado</option>
            <option value="Particular">Particular</option>
            <option value="Otro">Otro</option>
            <option value="Desplazado Contributivo">Desplazado Contributivo</option>
            <option value="Desplazado Subsidiado">Desplazado Subsidiado</option>
            <option value="Desplazado Vinculado">Desplazado Vinculado</option>
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