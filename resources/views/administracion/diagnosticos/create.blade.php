
@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear diagnostico", "seccion" => "diagnostico"])

@endsection

@section('administracion')

    <div class="container-fluid">
        <form action="/diagnosticos" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input required type="text" class="form-control" id="codigo" name="codigo"  value="{{old('codigo')}}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descipción:</label>
                <input required type="text" class="form-control" id="descripcion" name="descripcion"  value="{{old('descripcion')}}">
            </div>

            <div class="form-group">
                <label for="cargo">Estado:</label>
                <select required class="form-control" id="estado"  name="estado" >
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
    </div>

    @stop
