@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Editar Manual #$manual->id", "seccion" => "manual"])

@endsection

@section('administracion')

{!! Form::model($manual, ['route' => ['manuales.update',$manual->id], 'method' => 'put']) !!}	

<div class="form-group">
    {!! Form::label('tipo','Nombre') !!}
    {!! Form::text('nombre',null,['class' => 'form-control'])!!}
 
</div>       

<div class="form-group">
    {!! Form::label('estado','Estado')   !!}  
    {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}  
</div>
 
<div class="modal-footer">         				
    <button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
</div>
{!! Form::close() !!}

@stop
