@extends('layouts.layout')
@section('content')
<br>
{!! Form::open(['route' => ['pacientes.update',$paciente->id], 'method' => 'put']) !!}
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
        <label for="label">Fecha Nacimiento: </label>
        <div class="input-group date datepicker">
            <input class="form-control" id="fechana" type="text" name="fecha_nacimiento" value="{{$paciente->fecha_nacimiento}}" />
            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>

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
        <select name="aseguradora_id" id="aseguradora_id" required class="form-control">
            <option value="">Seleccione una aseguradora</option>
            @foreach ($aseguradoras as $aseguradora)
                @if($aseguradora->id == $paciente->aseguradora_id)
                    <option value="{{$aseguradora->id}}" selected>{{$aseguradora->nombre}}</option>
                @else
                    <option value="{{$aseguradora->id}}">{{$aseguradora->nombre}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Contrato:</label>
        <input class="form-control" id="acontrato" type="text" name="contrato" required value="{{$paciente->contrato}}"/> 
    </div>
    <div class="form-group col-xs-12 col-md-2 col-lg-3">
        <label for="label">Regimen:</label>
        <select class="form-control" id="regimen" name="regimen">
            <option value="Contributivo" @if ($paciente->regimen === "Contributivo" ) selected @endif>Contributivo</option>
            <option value="Subsidiado" @if ($paciente->regimen === "Subsidiado" ) selected @endif>Subsidiado</option>
            <option value="Vinculado" @if ($paciente->regimen === "Vinculado" ) selected @endif>Vinculado</option>
            <option value="Particular" @if ($paciente->regimen === "Particular" ) selected @endif>Particular</option>
            <option value="Otro" @if ($paciente->regimen === "Otro" ) selected @endif>Otro</option>
            <option value="Desplazado Contributivo" @if ($paciente->regimen === "Desplazado Contributivo" ) selected @endif>Desplazado Contributivo</option>
            <option value="Desplazado Subsidiado" @if ($paciente->regimen === "Desplazado Subsidiado" ) selected @endif>Desplazado Subsidiado</option>
            <option value="Desplazado Vinculado" @if ($paciente->regimen === "Desplazado Vinculado" ) selected @endif>Desplazado Vinculado</option>
        </select>
    </div>
    <br>
    <div class="form-group col-xs-2 col-md-2 col-lg-2">
        <input class="btn btn-primary form-control text-center" type="submit" name="guardar" value="Guardar" />
    </div>
    {{ csrf_field() }}
    <br>
    <br>
{!! Form::close() !!}
@endsection