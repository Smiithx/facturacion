@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear Manual", "seccion" => "manual"])

@endsection

@section('administracion')
<div class="container-fluid">
    <form action="/manuales" method="POST">
        {!!csrf_field() !!}
        <div class="form-group">
            <label for="tipomanual">Tipo de manual:</label>
            <select class="form-control" id="tipomanual"  name="tipo" >
                <option value="ISS2001" {{old('tipo' == "ISS2001" ?"selected":"")}}>ISS2001</option>
                <option value="SOAT" {{old('tipo' == "SOAT" ?"selected":"")}}>SOAT</option>
                <option value="PARTICULAR" {{old('tipo' == "PARTICULAR" ?"selected":"")}}>PARTICULAR</option>
                <option value="OTRO" {{old('tipo' == "OTRO" ?"selected":"")}}>OTRO</option>
            </select>
        </div>
        <div class="form-group">
            <label for="codigosoat">Código SOAT:</label>
            <input type="text" class="form-control" id="codigosoat" name="codigosoat"  value="{{old('codigosoat')}}">
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado"  name="estado" >
                <option value="Activo" {{old('estado' == "Activo" ?"selected":"")}}>Activo</option>
                <option value="Inactivo" {{old('estado' == "Inactivo" ?"selected":"")}}>Inactivo</option>            
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear Manual</button>
        </div>
    </form>
</div>
@endsection
