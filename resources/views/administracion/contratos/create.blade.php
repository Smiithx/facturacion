@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Crear contrato", "seccion" => "contrato"])

@endsection

@section('administracion')
<div class="container-fluid">
    <form action="/contratos" method="POST">
        {!!csrf_field() !!}
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre"  value="{{old('nombre')}}">
        </div>
        <div class="form-group">
            <label for="nit">NIT:</label>
            <input type="text" class="form-control" id="nit" name="nit"  value="{{old('nit')}}">
        </div>
        <div class="form-group">
            <label for="diasvencimiento">Dias de vencimiento:</label>
            <input type="number" step="1" min="0" class="form-control" id="diasvencimiento" name="diasvencimiento"  value="{{old('diasvencimiento')}}">
        </div>
        <div class="form-group">
            <label for="id_manual">Manual</label>
            <select class="form-control" id="id_manual" required name="id_manual" >
                <option value="">Seleccione un manual</option>
                @foreach ($manuales as $manual)
                <option value="{{$manual->id}}" {{old('id_manual')  == $manual->id ?"selected":""}}>{{$manual->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="porcentaje">Porcentaje:</label>
            <input type="number"  step="0.01" min="0" class="form-control" id="porcentaje" name="porcentaje"  value="{{old('porcentaje')}}">
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado"  name="estado" >
                <option value="Activo" {{old('estado')  == "Activo" ?"selected":""}}>Activo</option>
                <option value="Inactivo" {{old('estado')  == "Inactivo" ?"selected":""}}>Inactivo</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </form>
</div>
@stop
