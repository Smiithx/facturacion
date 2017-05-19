@extends('administracion.index')

@section('menu')

@include('administracion.partials.menu',["pagina" => "Empresa", "seccion" => "empresa"])

@endsection

@section('administracion')

@section('administracion')

{!! Form::model($empresa, ['route' => ['empresa.update',$empresa->id], 'method' => 'put','enctype' => 'multipart/form-data']) !!}	

<div class="form-group">
    {!! Form::label('rezon_social','Razón social')   !!}	                          
    {!! Form::text('rezon_social',null,['class' => 'form-control'])   !!}  
</div>

<div class="form-group">
    {!! Form::label('nit','NIT')   !!}	                                
    {!! Form::text('nit',null,['class' => 'form-control'])   !!}
</div>

<div class="form-group">
    {!! Form::label('representante','Representante legal')   !!}	                 
    {!! Form::text('representante',null,['class' => 'form-control'])   !!}
</div>

<div class="form-group">
    {!! Form::label('direccion','Dirección')   !!}	                             
    {!! Form::text('direccion',null,['class' => 'form-control'])   !!}
</div>

<div class="form-group">
    {!! Form::label('telefono','Teléfono')   !!}	                                
    {!! Form::text('telefono',null,['class' => 'form-control'])   !!}
</div>

{!! Form::hidden('file2',null,['class' => 'form-control', 'readonly'])   !!}

<div class="form-group">
    {!! Form::label('logo','Logo') !!} 
    <div class="form-group logo">
        <img src="/imagenes/{{$empresa->file}}" alt="{{$empresa->file}}" class="img-responsive" id="logo">
    </div>
    {!! Form::file('file',['class' => 'form-control', 'id' => 'file'])   !!}
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Actualizar</button>	
</div>

{!! Form::close() !!}

<script src="{{asset('assets/js/empresa.js')}}"></script>

@stop