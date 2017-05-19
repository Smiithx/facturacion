
@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Aseguradoras", "seccion" => "aseguradora"])

@endsection

@section('administracion')

<div>
    <h3 class="text-center">Crear Diagnoticos</h3>

    <div class="container-fluid">
        <form action="/Diagnosticos" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="codigo">Codigo:</label>
                <input type="text" class="form-control" id="codigo" name="codigo"  value="{{old('codigo')}}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descipcion:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion"  value="{{old('descripcion')}}">
            </div>

            <div class="form-group">
                <label for="cargo">Estado:</label>
                <select class="form-control" id="estado"  name="estado" >
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>


                </select>

            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Crear Servicio</button>
            </div>
        </form>
    </div>
</div>@stop

