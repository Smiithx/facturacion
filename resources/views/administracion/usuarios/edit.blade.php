@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Editar usuario", "seccion" => "usuario"])

@endsection

@section('administracion')
    {!! Form::model($usuarios, ['route' => ['usuarios.update',$usuarios->id], 'method' => 'put','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {!! Form::label('name','Nombre')   !!}
        {!! Form::text('name',null,['class' => 'form-control','required'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Correo')   !!}
        {!! Form::text('email',null,['class' => 'form-control','required'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('documento','Documento')   !!}
        {!! Form::text('documento',null,['class' => 'form-control','required'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('firma','Firma')   !!}
        {!! Form::file('firma',['class' => 'form-control']) !!}
        {!! Form::hidden('file2',null,['class' => 'form-control', 'readonly'])   !!}
    </div>
    <div class="form-group">
        {!! Form::label('cargo','Cargo')   !!}
        {!!
        Form::select('cargo',
            ['medico' => 'Medico', 'enfermera' => 'Enfermera','admin' => 'Administrador','otro' => 'Otro'],
            null,
            ['class' => 'form-control','required'])
        !!}
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
    {!! Form::close() !!}
@stop
