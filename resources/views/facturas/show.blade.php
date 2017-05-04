@extends('layouts.layout')
@section('content')

    <h3 class="text-center">Factura # {{ $factura->id }}</h3>
    <hr>

    <div class="row form-group">
        <div class="form-group col-xs-12 col-md-6">
            <label for="label">Contrato:</label>
            <input readonly type="text" class="form-control" id="facturar_contrato" name="contrato"
                   value="{{ $factura->contrato }}"/>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label for="label">Fecha:</label>
            <input readonly type="text" class="form-control" id="fecha" name="fecha"
                   value="{{ $factura->created_at }}"/>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>

                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Paciente</th>
                        <th class="text-center">Documento</th>
                        <th class="text-center">Aseguradora</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Total</th>

                    </tr>
                    </thead>
                    <tbody id="facturar_tbody">
                    @foreach($ordenes as $orden)
                        <tr>
                            <td class='text-center'><a href='/ordenservicio/{{ $orden->id}}'
                                                       target='_blank'>{{ $orden->id}}</a></td>
                            <td>{{ $orden->nombre}}</td>
                            <td>{{ $orden->documento}}</td>
                            <td>{{ $orden->aseguradora_id->nombre}}</td>
                            <td>{{ $orden->created_at}}</td>
                            <td class='text-right'>{{ number_format($orden->orden_total,2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-right" colspan="5">Total facturado</th>
                        <th class="text-right" colspan="1">{{number_format($factura->factura_total, 2) }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group col-xs-12 col-md-12 col-lg-12">
        <a href="/facturas" class="btn btn-default pull-right">Regresar</a>
    </div>
@endsection

