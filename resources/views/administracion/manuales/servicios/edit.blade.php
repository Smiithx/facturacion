@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Editar servicio ".$manual_servicio->id_servicio->cups." - Manual ".$manual_servicio->id_manual->codigosoat, "seccion" => "manual"])

@endsection

@section('administracion')
<div class="container-fluid">
    {!! Form::model($manual_servicio, ['route' => ['manuales.servicios.update',$manual_servicio->id_manual->id,$manual_servicio->id], 'method' => 'put']) !!}
        <div class="form-group">
            <label for="id_servicio">Servicios:</label>
            <select required class="form-control" id="id_servicio"  name="id_servicio" >
                <option value="">Seleccione un servicio</option>
                @foreach ($servicios as $servicio)
                    <option value="{{$servicio->id}}" {{$manual_servicio->id_servicio->id == $servicio->id ? "selected":""}}>{{$servicio->cups." - ".$servicio->descripcion}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="costo">Costo:</label>
            <input required type="number" step="0.01" min="0" class="form-control" id="costo" name="costo"  value="{{$manual_servicio->costo}}">
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select required class="form-control" id="estado"  name="estado" >
                <option value="Activo" {{$manual_servicio->estado == "Activo" ?"selected":""}}>Activo</option>
                <option value="Inactivo" {{$manual_servicio->estado == "Inactivo" ?"selected":""}}>Inactivo</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection
