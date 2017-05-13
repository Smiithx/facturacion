@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Crear paciente</h3>
    <hr>
    <form action="{{url('pacientes')}}" method="POST" name="frm_reg_paciente">
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Documento:</label>
            <input type="text" class="form-control" id="documento" name="documento" required
                   value="{{old('documento')}}"/>
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Tipo:</label>
            <select class="form-control" id="tipodoc" name="tipo_documento">
                <option value="CC" {{old('tipo_documento') == "CC" ? "selected":""}}>CC</option>
                <option value="TI" {{old('tipo_documento') == "TI" ? "selected":""}}>TI</option>
                <option value="RC" {{old('tipo_documento') == "CC" ? "selected":""}}>RC</option>
                <option value="CE" {{old('tipo_documento') == "RC" ? "selected":""}}>CE</option>
                <option value="AS" {{old('tipo_documento') == "AS" ? "selected":""}}>AS</option>
                <option value="MS" {{old('tipo_documento') == "MS" ? "selected":""}}>MS</option>
                <option value="PA" {{old('tipo_documento') == "PA" ? "selected":""}}>PA</option>
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
                <option value="Años" {{old('tipo_edad') == "Años" ? "selected":""}}>Años</option>
                <option value="Meses" {{old('tipo_edad') == "Meses" ? "selected":""}}>Meses</option>
                <option value="Dias" {{old('tipo_edad') == "Dias" ? "selected":""}}>Días</option>
            </select>
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Fecha de nacimiento:</label>
            <div class="input-group date datepicker">
                <input class="form-control" id="fechana" type="text" name="fecha_nacimiento" required
                       value="{{old('fecha_nacimiento')}}"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Sexo:</label>
            <select class="form-control" id="sexo" name="sexo">
                <option value="Femenino" {{old('sexo') == "sexo" ? "selected":""}}>Femenino</option>
                <option value="Masculino" {{old('sexo') == "Masculino" ? "selected":""}}>Masculino</option>
            </select>
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Telefono:</label>
            <input class="form-control" id="telefono" type="text" name="telefono" required value="{{old('telefono')}}"/>
        </div>
        <br>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Dirección:</label>
            <input class="form-control" id="direccion" type="text" name="direccion" required
                   value="{{old('direccion')}}"/>
        </div>
        <br>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Aseguradora:</label>
            <select name="aseguradora_id" id="aseguradora_id" required class="form-control">
                <option value="">Seleccione una aseguradora</option>
                @foreach ($aseguradoras as $aseguradora)
                    <option value="{{$aseguradora->id}}" {{old('aseguradora_id') == $aseguradora->id ? "selected":""}}>{{$aseguradora->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-xs-12 col-md-2 col-lg-3">
            <label for="label">Contrato:</label>
            <input class="form-control" id="acontrato" type="text" name="contrato" required
                   value="{{old('contrato')}}"/>
        </div>
        <div class="form-group col-xs-12 col-md-2 col-lg-3">
            <label for="label">Regimen:</label>
            <select class="form-control" id="regimen" name="regimen">
                <option value="Contributivo" {{old('regimen') == "Contributivo" ? "selected":""}}>Contributivo</option>
                <option value="Subsidiado" {{old('regimen') == "Subsidiado" ? "selected":""}}>Subsidiado</option>
                <option value="Vinculado" {{old('regimen') == "Vinculado" ? "selected":""}}>Vinculado</option>
                <option value="Particular" {{old('regimen') == "Particular" ? "selected":""}}>Particular</option>
                <option value="Otro" {{old('regimen') == "Otro" ? "selected":""}}>Otro</option>
                <option value="Desplazado Contributivo" {{old('regimen') == "Desplazado Contributivo" ? "selected":""}}>Desplazado Contributivo</option>
                <option value="Desplazado Subsidiado" {{old('regimen') == "Desplazado Subsidiado" ? "selected":""}}>Desplazado Subsidiado</option>
                <option value="Desplazado Vinculado" {{old('regimen') == "Desplazado Vinculado" ? "selected":""}}>Desplazado Vinculado</option>
            </select>
        </div>
        <br>
        <div class="form-group col-xs-2 col-md-2 col-lg-2 pull-right">
            <input class="btn btn-primary form-control" type="submit" name="guardar" value="Crear"/>
        </div>
        {{ csrf_field() }}
        <br>
        <br>
    </form>
@endsection