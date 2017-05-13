@extends('administracion.index')
@section('administracion')
<div>
    <h3 class="text-center">Crear Contratos</h3>
    <div class="container-fluid">
        <form action="/Contratos" method="POST">
            {!!csrf_field() !!}
            <div class="form-group">
                <label for="contrato">Contrato:</label>
                <input type="text" class="form-control" id="contrato" name="contrato"  value="{{old('contrato')}}">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre"  value="{{old('nombre')}}">
            </div>
            <div class="form-group">
                <label for="nit">Nit:</label>
                <input type="text" class="form-control" id="nit" name="nit"  value="{{old('nit')}}">
            </div>
            <div class="form-group">
                <label for="diasvencimiento">Dias de vencimiento:</label>
                <input type="text" class="form-control" id="diasvencimiento" name="diasvencimiento"  value="{{old('diasvencimiento')}}">
            </div>
            <div class="form-group">
                <label for="manualtarifario">Manual Tarifario</label>
                <select class="form-control" id="id_manual" required name="id_manual" >
                    <option value="">Seleccione un manual</option>
                    @foreach ($manuales as $manuale)
                    <option value="{{$manuale->id}}">{{$manuale->codigosoat}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="porcentaje">Porcentaje:</label>
                <input type="number"  step="0.01" class="form-control" id="porcentaje" name="porcentaje"  value="{{old('porcentaje')}}">
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
