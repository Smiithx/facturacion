@extends('layouts.layout')
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <caption class="text-center">
                <h2>Pacientes</h2>
                {!! Form::open(['route' => 'pacientes.index', 'method' => 'GET', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('name',null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Aseguradora</th>
                <th>Contrato</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->documento }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->getEdad() }}</td>
                    <td>{{ $paciente->sexo }}</td>
                    <td>{{ $paciente->aseguradora_id->nombre }}</td>
                    <td>{{ $paciente->id_contrato->nombre }}</td>
                    <td class="acciones">
                        <a href="/pacientes/{{$paciente->id}}/edit" class="btn btn-success" data-toggle='tooltip'
                           title='Editar' target="_blank">
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['pacientes.destroy', $paciente->id], 'method' => 'delete','id' => 'form-eliminar-paciente']) !!}
                        {{ csrf_field() }}
                        <button type="submit" data-id="{{$paciente->id}}" class="btn btn-danger btn-eliminar-paciente"
                                data-toggle='tooltip' title='Eliminar' target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container-fluid text-center">
            {!! $pacientes->render() !!}
        </div>
    </div>
    <script src="{{asset('assets/js/pacientes.js')}}"></script>
@endsection