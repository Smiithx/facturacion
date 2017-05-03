@extends('layouts.layout')
@section('content')
    <h3 class="text-center">Orden de servicio</h3>
    <hr>
        {{ csrf_field() }}
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
        @foreach($ordenservicios as $ordenservicio)     
               
            <label for="label">Documento:</label>
            <input  readonly type="text" class="form-control" id="orden-documento" name="documento"
                   value="{{ $ordenservicio->documento }}"/>
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Nombre:</label>
            <input  readonly class="form-control" id="orden-nombre" type="text" name="nombre"
                   value="{{ $ordenservicio->nombre }}"/>
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Aseguradora:</label>
            <input type="text"  readonly class="form-control" name="aseguradora_id" id="orden-aseguradora" value="{{ $ordenservicio->aseguradora_id }}">
            
        </div>
        <div class="form-group col-xs-12 col-md-3 col-lg-3">
            <label for="label">Contrato:</label>
            <input  readonly class="form-control" id="orden-contrato" type="text" name="contrato"
                   value="{{ $ordenservicio->contrato }}"/>
        </div>
         @endforeach
        <br>
        <br>
        <div class="col-xs-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tbl_factura">
                        <thead>
                        <tr class="text-center">
                            <th>Cups</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Copago</th>
                            <th>Valor Unitario</th>
                            <th>Valor Total</th>
                        </tr>
                        </thead>
                        <tbody id="orden_servicios_servicios">
                         @foreach($OrdenServicio_Items as $OrdenServicio_Item)
     
                        <tr>
                            <td>
                                <input  readonly  required type="text" name="cups[]" class="form-control orden_servicios_cups"
                                       value="{{ $OrdenServicio_Item->cups }}"></td>
                            <td>
                                <input  readonly required type="text" name="descripcion[]" readonly
                                       class="form-control orden_servicios_descripcion" value="{{ $OrdenServicio_Item->descripcion }}">
                            </td>
                            <td>
                                <input readonly  required type="number" name="cantidad"
                                       class="form-control orden_servicios_cantidad" value="{{ $OrdenServicio_Item->cantidad }}"></td>
                            <td>
                                <input  readonly required type="number" step="0.01" name="copago"
                                       class="form-control orden_servicios_copago" value="{{ $OrdenServicio_Item->copago }}"></td>
                            <td>
                                <input readonly  required type="number" step="0.01" name="valor_unitario" value="{{ $OrdenServicio_Item->valor_unitario }}" class="form-control orden_servicios_valor_unitario"></td>
                            <td>
                                <input required type="number" step="0.01" name="valor_total" readonly value="{{ $OrdenServicio_Item->valor_total }}" 
                                       class="form-control orden_servicios_valor_total"></td>
                        </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                      
                        </tfoot>
                    </table>
                </div>
                <hr>
            </div>
        </div>
      
 
    <script src="{{asset('assets/js/orden_de_servicios.js')}}"></script>
@endsection

