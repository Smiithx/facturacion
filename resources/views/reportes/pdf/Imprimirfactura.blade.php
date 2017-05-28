   @include('reportes.pdf.layouts.plantilla')
   <h3>Reporte Factura</h3>

    <table style="width:100%;" class="table table-striped table-bordered table-hover hidden" id="tabla_r4">
        <thead style="color:#fff; background: #3b5998;">
            <tr>
                <th class="text-center">N° Factura</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Aseguradora</th>
                <th class="text-center">Contrato</th>
                <th class="text-center">Total</th>

            </tr>
        </thead>
        <tbody>
        <tr>
                <td class="text-center"> {{$facturas->id}}</td>
                <td class="text-center"> {{$facturas->id}}</td>
                <td class="text-center"> {{$facturas->id}}</td>
                <td class="text-center"> {{$facturas->id}}</td>
                <td class="text-center"> {{$facturas->id}}</td>
                <td class="text-center"> {{$facturas->factura_total}}</td>
                 </tr>
        </tbody>

 
    </table>
</div>
