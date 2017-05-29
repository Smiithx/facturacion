@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Aseguradoras", "seccion" => "aseguradora"])

@endsection

@section('administracion')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_aseguradoras">
            <caption class="text-center">
                {!! Form::open(['route' => 'aseguradoras.index', 'method' => 'GET', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('nombre',$nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" data-toggle="modal" data-target="#modalaseguradora"
                       class="btn btn-primary">Nuevo</a>
                </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">NIT</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($aseguradoras as $aseguradora)
                <tr>
                    <td class="text-center">{{ $aseguradora->id }}</td>
                    <td>{{ $aseguradora->nombre }}</td>
                    <td>{{ $aseguradora->nit }}</td>
                    <td class="text-center">{{ $aseguradora->estado }}</td>
                    <td class="acciones">
                        <a href="/aseguradoras/{{$aseguradora->id}}/edit" class="btn btn-success" data-toggle='tooltip'
                           title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['aseguradoras.destroy', $aseguradora->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'
                                target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container-fluid text-center">
            {!! $aseguradoras->render()!!}
        </div>
    </div>
    <!-- MODAL ASEGURADORA -->

    <div class="modal fade" tabindex="-1" id="modalaseguradora" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Crear Aseguradora</h4>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="container-fluid">
                        <form action="/aseguradoras" method="POST">
                            {!!csrf_field() !!}
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                       value="{{old('nombre')}}">
                            </div>
                            <div class="form-group">
                                <label for="nit">NIT:</label>
                                <input type="text" class="form-control" id="nit" name="nit" required
                                       value="{{old('nit')}}">
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!-- /Fin modal Aseguradora-->
@stop
