@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear Manual", "seccion" => "manual"])

@endsection

@section('administracion')


<div class="container-fluid">
    <form action="/manuales" method="POST">
        {!!csrf_field() !!}
        <div class="form-group">
            <label for="nombre">Nombre :</label>
            <input type="text" class="form-control" id="nombre"  name="nombre" >
               
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
