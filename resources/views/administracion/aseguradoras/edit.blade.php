@extends('administracion.index')
@section('administracion')
  <div>
		            	
		       <h3 class="text-center">Editar Aseguradora: {{ $aseguradora->nombre }}</h3>
                 
{!! Form::model($aseguradora, ['route' => 'Aseguradora.update', 'method' => 'PUT']) !!}	
                        {!! Form::label('nombre','Nombre Aseguradora')   !!}	                                
                         {!! Form::text('nombre',null,['class' => 'form-control'])   !!}     
                         {!! Form::label('nit','NIT')   !!}	                                
                         {!! Form::text('nit',null,['class' => 'form-control'])   !!}
                         {!! Form::label('estado','Estado')   !!}	                                
                         {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}             				
		                	<button type="submit" class="btn btn-default">Actualizar</button>	
                     
                        {!! Form::close() !!}
                        
		                </div> @stop
