@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Aseguradoras", "seccion" => "aseguradora"])

@endsection

@section('administracion')
<div>

    <h3 class="text-center">Editar Diagnosticos: {{ $diagnosticos->codigo }}</h3>

    {!! Form::model($diagnosticos, ['route' => ['Diagnosticos.update',$diagnosticos->id], 'method' => 'put']) !!}	

    {!! Form::label('codigo','Codigo')   !!}
    {!! Form::text('codigo',null,['class' => 'form-control'])!!} 

    {!! Form::label('descripcion','Descripcion')   !!}
    {!! Form::text('descripcion',null,['class' => 'form-control'])!!}



    {!! Form::label('estado','Estado')   !!}  
    {!! Form::select('estado',['Activo' => 'Activo', 'Inactivo' => 'Inactivo'],null,['class' => 'form-control'])   !!}     
    <br>          				
    <button type="submit" class="btn btn-primary pull-right col-xs-3">Actualizar</button>	

    {!! Form::close() !!}

</div> @stop
