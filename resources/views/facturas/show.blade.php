@extends('layouts.layout')
@section('content')

    <h3 class="text-center">Factura # {{ $factura->id }}</h3>
    <hr>

        <div class="row form-group">
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
            
               
           
                <label for="label">Contrato:</label>
                <input readonly type="text" class="form-control" id="facturar_contrato" name="contrato" value="{{ $factura->contrato }}"/>
            </div>
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">Fecha:</label>
                 <input readonly type="text" class="form-control" id="fecha" name="fecha" value="{{ $factura->created_at }}"/>
                </div>
          
            <div class="form-group col-xs-12 col-md-3 col-lg-3">
                <label for="label">#Factura:</label>
             <input readonly type="text" class="form-control" id="numero" name="numero" value="{{ $factura->id }}"/>

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
                                <td>{{ $orden->id}}</td>
                                <td>{{ $orden->nombre}}</td>
                                <td>{{ $orden->documento}}</td>
                                <td>{{ $orden->aseguradora_id}}</td>
                                <td>{{ $orden->created_at}}</td>
                                <td>{{ $orden->orden_total}}</td>

                            </tr>

                            @endforeach 



                        </tbody>
                        <tfoot>
                            <tr><td colspan="4"></td><td><strong>Total Facturado</strong></td><td><strong>{{number_format($factura->factura_total, 2) }}</strong></td></tr>
                         
                        </tfoot>
                      
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12 col-lg-12">
            <input class="btn btn-danger pull-right" type="button" id="btn-facturar" value="Regresar">
        </div>
        {{ csrf_field()}}
    </form>
    <script src="{{asset('assets/js/factura.js')}}"></script>
@endsection

