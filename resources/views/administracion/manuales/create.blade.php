@extends('administracion.index')
@section('administracion')
<div>
    <h3 class="text-center">Crear Manuales </h3>
    <div class="container-fluid">
        <form action="/Manuales" method="POST">
            {!!csrf_field() !!}
            <div class="form-group">
                <label for="tipomanual">Tipo de manual:</label>
                <select class="form-control" id="tipomanual"  name="tipomanual" >
                    <option value="ISS2001">ISS2001</option>
                    <option value="SOAT">SOAT</option>
                    <option value="PARTICULAR">PARTICULAR</option>
                    <option value="OTRO">OTRO</option>
                </select>
                <div class="form-group">
                    <label for="servicios_id">Cups:</label>
                    <select class="form-control" id="servicios_id" required name="servicios_id" >
                        <option value="">Seleccione un Cups</option>
                        @foreach ($servicios as $servicio)
                        <option value="{{$servicio->id}}">{{$servicio->cups." - ".$servicio->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="codigosoat">Código soat:</label>
                    <input type="text" class="form-control" id="codigosoat" name="codigosoat"  value="{{old('codigosoat')}}">
                </div>
                <div class="form-group">
                    <label for="costo">Costo:</label>
                    <input type="number" step="0.01" class="form-control" id="costo" name="costo"  value="{{old('costo')}}">
                </div>
                <div class="form-group">
                    <label for="cargo">Estado:</label>
                    <select class="form-control" id="estado"  name="estado" >
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>            
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear Manual</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
