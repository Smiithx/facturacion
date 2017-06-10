@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Agregar servicio - Manual: $manual->codigosoat", "seccion" => "manual"])

@endsection

@section('administracion')
<div class="container-fluid">
    <form action="/manuales/{{$manual->id}}/servicios" method="POST">
        {!!csrf_field() !!}
        <div class="form-group">
            <label for="id_servicio">Servicio:</label>
            <select required class="form-control" id="id_servicio"  name="id_servicio" >
                <option value="">Seleccione un servicio</option>
                @foreach ($servicios as $servicio)
                    <option value="{{$servicio->id}}" {{old('id_servicio') == $servicio->id ? "selected":""}}>{{$servicio->cups." - ".$servicio->descripcion}}</option>
                @endforeach
            </select>
        </div>
      
        <div class="form-group">
            <label for="costo">Costo:</label>
            <input required type="number" step="0.01" min="0" class="form-control" id="costo" name="costo"  value="{{old('costo')}}">
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select required class="form-control" id="estado"  name="estado" >
                <option value="Activo" {{old('estado' == "Activo" ?"selected":"")}}>Activo</option>
                <option value="Inactivo" {{old('estado' == "Inactivo" ?"selected":"")}}>Inactivo</option>            
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Agregar servicio</button>
        </div>
    </form>
</div>
@endsection
