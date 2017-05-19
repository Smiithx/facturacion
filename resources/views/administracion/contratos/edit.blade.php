@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Editar contrato #$contrato->id", "seccion" => "contrato"])

@endsection

@section('administracion')

{!! Form::model($contrato, ['route' => ['contratos.update',$contrato->id], 'method' => 'put']) !!}

<div class="form-group">
    {!! Form::label('nombre','Nombre')   !!}
    {!! Form::text('nombre',null,['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('nit','NIT')   !!}
    {!! Form::text('nit',null,['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('diasvencimiento','Dias de vencimiento')   !!}
    {!! Form::text('diasvencimiento',null,['class' => 'form-control', 'step' =>'1', 'type' => 'number', 'min' => '0'])!!}
</div>

<div class="form-group">
    <label for="id_manual">Manual</label>
    <select class="form-control" id="id_manual" required name="id_manual" >
        @foreach ($manuales as $manual)
        <option value="{{$manual->id}}" {{old('id_manual')  == $manual->id ?"selected":""}}>{{$manual->codigosoat}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('porcentaje','Porcentaje')   !!}
    {!! Form::text('porcentaje',null,['class' => 'form-control', 'step' =>'0.01', 'type' => 'number', 'min' => '0'])!!}
</div>

<div class="form-group">
    {!! Form::label('estado','Estado')   !!}
    {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Actualizar</button>
</div>

{!! Form::close() !!}

@stop
