@extends('layouts.layout')
@section('content')

    <h3 class="text-center">Factura</h3>
    <hr>

    <div class="row form-group">
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Nº de Factura:</label>
            <input type="text" class="form-control" id="reporte_factura_numero_factura"/>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Contrato:</label>
            <select readonly id="reporte_factura_contrato" class="form-control">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha de facturación:</label>
            <input readonly type="text" class="form-control" id="reporte_factura_fecha_facturacion"/>
        </div>
        <div class="form-group col-xs-12 col-md-3">
            <label for="label">Fecha de radicación:</label>
            <input readonly type="text" class="form-control" id="reporte_factura_fecha_radicacion"/>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">Cups</th>
                        <th class="text-center">Descripciòn</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Copago</th>
                        <th class="text-center">Valor unitario</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody id="reporte_factura_tbody">
                    <tr>
                        <td class='text-center'><a href='' target='_blank'></a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class='text-right'></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th class="text-right" colspan="1" id="reporte_factura_total"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group col-xs-12 text-right">
        <a href="/facturas" class="btn btn-success">Regresar</a>
        <button class="btn btn-primary hidden" id="reporte_factura_btn_imprimir">Imprimir</button>
    </div>
    <script src="{{asset('assets/js/factura.js')}}"></script>
@endsection

