@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear servicio", "seccion" => "servicio"])

@endsection

@section('administracion')
<div class="container-fluid">
    <form action="/servicios" method="POST">
        {!!csrf_field() !!}
        <div class="form-group">
            <label for="cups">Cups:</label>
            <input required type="text" class="form-control" id="cups" name="cups"  value="{{old('cups')}}">
        </div>
        <div class="form-group">
            <label for="descripcion">Descipcion:</label>
            <input required type="text" class="form-control" id="descripcion" name="descripcion"  value="{{old('descripcion')}}">
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado"  name="estado" required>
                <option value="Activo" {{old('estado') == "Activo" ? "selected":""}}>Activo</option>
                <option value="Inactivo" {{old('estado') == "Inactivo" ? "selected":""}}>Inactivo</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear Servicio</button>
        </div>
    </form>
</div>
@stop
