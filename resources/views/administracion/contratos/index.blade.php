@extends('administracion.index')
@section('administracion')
    <div>
        <h3 class="text-center">Contratos</h3>

        @if (Session::has('message'))
            <p class="alert alert-success">{{Session::get('message')}}</p>
        @endif
        <a title="Agregar" href="/administracion/contratos/create"
           class="btn btn-primary pull-right servicios">Nuevo</a>
        <br>
        <br>
        <table class="table table-striped table-bordered table-hover table-responsive">
            <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Nit</th>
                <th class="text-center">Dias Venci.</th>
                <th class="text-center">Manual Tarif.</th>
                <th class="text-center">Porcentaje</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <form action="/Contratos/buscar" method="POST">
                <div class="input-group">
                    <input type="text-center" placeholder="Contrato" class="form-control" name="nombre">
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    {{ csrf_field() }}
                </div>
                <br>
            </form>
            <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->nombre }}</td>
                    <td>{{ $contrato->nit}}</td>
                    <td class="text-center">{{ $contrato->diasvencimiento }}</td>
                    <td>{{ $contrato->codigosoat }}</td>
                    <td class="text-center">{{ $contrato->porcentaje }}%</td>
                    <td class="text-center">{{ $contrato->estado }}</td>
                    <td class="acciones">
                        <a href="/administracion/contratos/{{$contrato->id}}/edit" class="btn btn-success"
                           data-toggle='tooltip' title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>

                        {!! Form::open(['route' => ['Contratos.destroy', $contrato->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'
                                target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="8" class="text-center">{!! $contratos->render() !!}</td>
            </tr>
            </tfoot>
        </table>
    </div>
@stop