@extends('administracion.index')
@section('administracion')
  <div>
		            	
		       <h3 class="text-center">Editar Servicio: {{ $servicios->nombre }}</h3>
                 
{!! Form::model($servicios, ['route' => ['Servicios.update',$servicios->id], 'method' => 'put']) !!}	

                        {!! Form::label('cups','cups')   !!}
                        {!! Form::text('cups',null,['class' => 'form-control'])!!} 

                         {!! Form::label('descripcion','Descripcion')   !!}
                         {!! Form::text('descripcion',null,['class' => 'form-control'])!!}

                         

                        {!! Form::label('estado','Estado')   !!}  
                        {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}   
                         <br>          				
		                	<button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
                     
                        {!! Form::close() !!}
                        
		                </div> @stop
