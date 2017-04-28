@extends('administracion.index')
@section('administracion')
  <div>
		           

		       <h3 class="text-center">Editar Contrato: {{ $contratos->id }}</h3>
                 
                          {!! Form::model($contratos, ['route' => ['Contratos.update',$contratos->id], 'method' => 'put']) !!}	
         
                          {!! Form::label('contrato','Contrato')   !!}
                         {!! Form::text('contrato',null,['class' => 'form-control'])!!}
 
                          {!! Form::label('nombre','Nombre')   !!}
                         {!! Form::text('nombre',null,['class' => 'form-control'])!!}

                          {!! Form::label('nit','Nit')   !!}
                          {!! Form::text('nit',null,['class' => 'form-control', 'step' =>'0.01'])!!}

                       
                         {!! Form::label('diasvencimiento',' Dia de Vencimiento')   !!}
                         {!! Form::text('diasvencimiento',null,['class' => 'form-control', 'step' =>'0.01'])!!}
  


                         {!! Form::label('id_manual','Manual Tarif')   !!}
                         {!! Form::select('servicios_id', $manuales, null, ['class' => 'form-control']) !!}  



                         {!! Form::label('porcentaje','Porcentaje')   !!}
                         {!! Form::text('porcentaje',null,['class' => 'form-control', 'step' =>'0.01'])!!}


                        {!! Form::label('estado','Estado')   !!}  
                        {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!} 

                         <br>          				
		                	<button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	
                     
                        {!! Form::close() !!}
                        
		                </div> @stop
