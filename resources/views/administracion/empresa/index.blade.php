@extends('administracion.index')
@section('administracion')
   <div >
                        @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
                        
                        <h3 class="text-center">Ajuste Empresa</h3>
                 
{!! Form::model($empresa, ['route' => ['Empresa.update',$empresa->id], 'method' => 'put','enctype' => 'multipart/form-data']) !!}	

                        {!! Form::label('rezon_social','Razón social')   !!}	                          {!! Form::text('rezon_social',null,['class' => 'form-control'])   !!}  
                            
                         {!! Form::label('nit','NIT')   !!}	                                
                         {!! Form::text('nit',null,['class' => 'form-control'])   !!}
                         
                          {!! Form::label('representante','Representante legal')   !!}	                 {!! Form::text('representante',null,['class' => 'form-control'])   !!}
                          
                          {!! Form::label('direccion','Dirección')   !!}	                             
                         {!! Form::text('direccion',null,['class' => 'form-control'])   !!}
                         
                         
                          {!! Form::label('telefono','Teléfono')   !!}	                                
                         {!! Form::text('telefono',null,['class' => 'form-control'])   !!}
                           
                         {!! Form::hidden('file2',null,['class' => 'form-control', 'readonly'])   !!}

                         {!! Form::label('file2','Logo')   !!} 

<br>
                   <img width="200px" height="100px" src="imagenes/{{$empresa->file}}" alt="{{$empresa->file}}"">
       
                 <br><br>
                       {!! Form::file('file',null,['class' => 'form-control'])   !!}
                                                
         				
		                	<button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
                     
                        {!! Form::close() !!}
		                	
		                	
						          
		                </div>
		                @stop