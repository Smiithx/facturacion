@extends('layouts.layout')
@section('content')
<br>
<form action="{{url('pacientes')}}" method="POST" name="frm_reg_paciente" >
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Documento:</label>
        <input type="text" class="form-control" id="documento" name="documento" required value="{{old('documento')}}"/>
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
        <input class="form-control" id="nombre" type="text" name="nombre" required value="{{old('nombre')}}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Edad:</label>
        <input class="form-control" id="edad" type="number" name="edad" required min="1" value="{{old('edad')}}"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Tipo de edad:</label>
        <select class="form-control" id="anos" name="tipo_edad">
            <option value="Años">Años</option>
            <option value="Meses">Meses</option>
            <option value="Dias">Días</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Fecha de nacimiento:</label>
        <input class="form-control datepicker" id="fechana" type="text" name="fecha_nacimiento" required value="{{old('fecha_nacimiento')}}"/>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Sexo:</label>
        <select class="form-control" id="sexo"  name="sexo">
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Telefono:</label>
        <input class="form-control" id="telefono" type="text" name="telefono" required value="{{old('telefono')}}"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Dirección:</label>
        <input class="form-control" id="direccion" type="text" name="direccion" required value="{{old('direccion')}}"/>
    </div>
    <br>
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <label for="label">Aseguradora:</label>
        <input class="form-control" id="aseguradora" type="text" name="aseguradora" required value="{{old('aseguradora')}}"/>
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Contrato:</label>
        <input class="form-control" id="acontrato" type="text" name="contrato" required value="{{old('contrato')}}"/>
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
        <input class="btn btn-primary form-control text-center" type="submit" name="guardar" value="Crear" />
    </div>
    {{ csrf_field() }}
    <br>
    <br>
</form>
@endsection