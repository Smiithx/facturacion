@extends('administracion.index')
@section('administracion')
  <div>
		            	
		       <h3 class="text-center">Editar Usuario: {{ $usuarios->nombre }}</h3>
                 
{!! Form::model($usuarios, ['route' => ['Usuarios.update',$usuarios->id], 'method' => 'put','enctype' => 'multipart/form-data']) !!}
                        {!! Form::label('nombre','Nombre Usuario')   !!}
                        {!! Form::text('nombre',null,['class' => 'form-control'])!!} 

                         {!! Form::label('documento','Documento')   !!}
                         {!! Form::text('documento',null,['class' => 'form-control'])!!}

                         {!! Form::label('firma','Firma')   !!}	
                         {!! Form::file('firma',null,['class' => 'form-control']) !!}

                         {!! Form::hidden('file2',null,['class' => 'form-control', 'readonly'])   !!}
                         
                        {!! Form::label('cargo','cargo')   !!}  
                        {!! Form::select('cargo',['Medicos' => 'Medicos', 'Enfermeras' => 'Enfermeras'],null,['class' => 'form-control'])   !!}   
                         <br>          				
		                	<button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
                     
                        {!! Form::close() !!}
                        
		                </div> @stop
