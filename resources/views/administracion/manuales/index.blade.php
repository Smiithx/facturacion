@extends('administracion.index')

@section('menu')

    @include('administracion.partials.menu',["pagina" => "Manuales", "seccion" => "manual"])

@endsection

@section('administracion')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla_manuales">
            <caption class="text-center">
                {!! Form::open(['route' => 'manuales.index', 'method' => 'GET', 'role' => 'search']) !!}
                <div class="input-group">
                    {!! Form::text('nombre',$nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </span>
                    <span class="input-group-btn">
                    <a title="Agregar" href="/manuales/create" class="btn btn-primary servicios">Nuevo</a>
                </span>
                </div>
                {!! Form::close() !!}
                <br>
            </caption>
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($manuales as $manual)
                <tr>
                    <td class="text-center"><a href="/manuales/{{ $manual->id }}">{{ $manual->id }}</a></td>
                    <td>{{ $manual->nombre }}</td>
                    <td class="text-center">{{ $manual->estado }}</td>
                    <td class="acciones">
                        <button class="btn btn-info btn_manuales_servicios" data-toggle="modal"
                                data-id="{{ $manual->id }}"
                                data-target=".manual_show">
                            <i class='glyphicon glyphicon-plus' data-toggle='tooltip' title='Servicios'></i>
                        </button>
                        <a href="/manuales/{{$manual->id}}/edit" class="btn btn-success" data-toggle='tooltip'
                           title='Editar'>
                            <i class='glyphicon glyphicon-edit'></i>
                        </a>
                        {!! Form::open(['route' => ['manuales.destroy', $manual->id], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-danger" data-toggle='tooltip' title='Eliminar'
                                target="_blank">
                            <i class='glyphicon glyphicon-remove'></i>
                        </button>
                        {!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container-fluid text-center">
            {!! $manuales->render() !!}
        </div>
    </div>
    <!-- Modals -->

    <!-- manual show -->
    <div class="modal fade manual_show" tabindex="-1" role="dialog" data-id="" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Servicios</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tabla_manuales">
                                <caption class="text-center">
                                    <div class="input-group">
                                        <input type="text" name="cup" class="form-control" id="manuales_servicios_cups"
                                               placeholder="cups">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default"
                                                    id="manuales_servicios_buscar">Buscar</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal_manual_servicios_create">
                                                Agregar
                                            </button>
                                        </span>
                                    </div>
                                    <br>
                                </caption>
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Soat</th>
                                    <th class="text-center">Cups</th>
                                    <th class="text-center">Descripcion</th>
                                    <th class="text-center">Costo</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="manuales_servicios_tbody"></tbody>
                            </table>
                            <div class="container-fluid text-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination" id="manuales_servicios_paginacion"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- manual create -->
    <div class="modal fade" id="modal_manual_servicios_create" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar servicio</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="form_manuales_servicios_agregar" action="{{--/manuales/{{$manual->id}}/servicios--}}" method="POST">
                            <div class="form-group">
                                {!!csrf_field() !!}
                            </div>
                            <div class="form-group">
                                <label for="id_servicio">Servicio:</label>
                                <select required class="form-control" id="id_servicio" name="id_servicio">
                                    <option value="">Seleccione un servicio</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{$servicio->id}}" {{old('id_servicio') == $servicio->id ? "selected":""}}>{{$servicio->cups." - ".$servicio->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="costo">Costo:</label>
                                <input required type="number" step="0.01" min="0" class="form-control" id="costo"
                                       name="costo" value="{{old('costo')}}">
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select required class="form-control" id="estado" name="estado">
                                    <option value="Activo" {{old('estado' == "Activo" ?"selected":"")}}>Activo</option>
                                    <option value="Inactivo" {{old('estado' == "Inactivo" ?"selected":"")}}>Inactivo
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="manual_servicios_agregar">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- manual edit -->
    <div class="modal fade" id="modal_manual_servicios_editar" data-id="" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar servicio</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="form_manuales_servicios_editar" action="" method="POST">
                            <div class="form-group">
                                <input name="_method" type="hidden" value="PUT">
                                {!!csrf_field() !!}
                            </div>
                            <div class="form-group">
                                <label for="manual_servicio_id_servicio">Servicio:</label>
                                <select required id="manual_servicio_editar_id_servicio" class="form-control" name="id_servicio">
                                    @foreach ($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->cups." - ".$servicio->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="costo">Costo:</label>
                                <input required type="number" step="0.01" min="0" class="form-control" id="manual_servicio_editar_costo"
                                       name="costo" value="">
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select required id="manual_servicio_editar_estado" class="form-control" name="estado">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="manual_servicios_editar_actualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- form eliminar -->
    <form method="POST" id="form_manual_servicio_eliminar" class="hidden" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="DELETE">
        {!!csrf_field() !!}
    </form>
@endsection
@section("scripts")
    <script src="{{asset('assets/js/manuales.js')}}"></script>
@endsection