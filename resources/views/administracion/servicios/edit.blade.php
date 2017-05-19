@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Editar servicio #$servicio->id", "seccion" => "servicio"])

@endsection

@section('administracion')

{!! Form::model($servicio, ['route' => ['servicios.update',$servicio->id], 'method' => 'put']) !!}	

<div class="form-group">
    {!! Form::label('cups','cups')   !!}
    {!! Form::text('cups',null,['class' => 'form-control',"required" => "required"])!!} 
</div>

<div class="form-group">
    {!! Form::label('descripcion','Descripcion')   !!}
    {!! Form::text('descripcion',null,['class' => 'form-control',"required" => "required"])!!}
</div>

<div class="form-group">
    {!! Form::label('estado','Estado')   !!}  
    {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control',"required" => "required"])   !!}   
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Actualizar</button>	
</div>        				

{!! Form::close() !!}

@stop
