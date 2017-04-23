@extends('administracion.index')
@section('administracion')
   <div >
                        @if (Session::has('message'))
		                	<p class="alert alert-success">{{Session::get('message')}}</p>
		                	@endif
                        
                        <h3 class="text-center">Editar Empresa</h3>
                 
{!! Form::model($empresa, ['route' => ['Empresa.update',$empresa->id], 'method' => 'put']) !!}	

                        {!! Form::label('rezon_social','Razón social')   !!}	                          {!! Form::text('rezon_social',null,['class' => 'form-control'])   !!}  
                            
                         {!! Form::label('nit','NIT')   !!}	                                
                         {!! Form::text('nit',null,['class' => 'form-control'])   !!}
                         
                          {!! Form::label('representante','Representante legal')   !!}	                 {!! Form::text('representante',null,['class' => 'form-control'])   !!}
                          
                          {!! Form::label('direccion','Dirección')   !!}	                             
                         {!! Form::text('direccion',null,['class' => 'form-control'])   !!}
                         
                         
                          {!! Form::label('telefono','Teléfono')   !!}	                                
                         {!! Form::text('telefono',null,['class' => 'form-control'])   !!}
                          
                           {!! Form::label('logo','Logo')   !!}	                                
                         {!! Form::file('logo',null,['class' => 'form-control'])   !!}
                         
                 
                         <br>          				
		                	<button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
                     
                        {!! Form::close() !!}
		                	
		                	
						          
		                </div>
		                @stop