@extends('administracion.index')
@section('administracion')
  <div>
		           

		       <h3 class="text-center">Editar Manual: {{ $manuales->id }}</h3>
                 
{!! Form::model($manuales, ['route' => ['Manuales.update',$manuales->id], 'method' => 'put']) !!}	


                        {!! Form::label('tipomanual','Tipo Manual')   !!}  
                        {!! Form::select('tipomanual',['ISS2001' => 'ISS2001', 'SOAT' => 'SOAT', 'PARTICULAR' => 'PARTICULAR', 'OTRO' => 'SOAT'],null,['class' => 'form-control'])   !!}              

                         {!! Form::label('cups_id','Cups')   !!}
                        {!! Form::text('cups_id',null,['class' => 'form-control'])!!} 

                         {!! Form::label('codigosoat','Soat')   !!}
                         {!! Form::text('codigosoat',null,['class' => 'form-control'])!!}

                         {!! Form::label('costo','Costo')   !!}
                         {!! Form::number('costo',null,['class' => 'form-control', 'step' =>'0.01'])!!}

                        {!! Form::label('estado','Estado')   !!}  
                        {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}   
                         <br>          				
		                	<button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
                     
                        {!! Form::close() !!}
                        
		                </div> @stop
