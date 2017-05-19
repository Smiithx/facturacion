@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Editar aseguradora - $aseguradora->nombre", "seccion" => "aseguradora"])

@endsection

@section('administracion')
<div>

    <h3 class="text-center">Editar Aseguradora: {{ $aseguradora->nombre }}</h3>

    {!! Form::model($aseguradora, ['route' => ['Aseguradora.update',$aseguradora->id], 'method' => 'put']) !!}	

    {!! Form::label('nombre','Nombre Aseguradora')   !!}	                                
    {!! Form::text('nombre',null,['class' => 'form-control'])   !!}     
    {!! Form::label('nit','NIT')   !!}	                                
    {!! Form::text('nit',null,['class' => 'form-control'])   !!}
    {!! Form::label('estado','Estado')   !!}	                                
    {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}   
    <br>          				
    <button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	

    {!! Form::close() !!}

</div> @stop
