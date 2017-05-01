<?php
namespace App\Http\Controllers;

use App\OrdenServicio_Items;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ordenservicios;
use App\Http\Requests\OrdenServiciosRequest;

class ordenserviciocontroller extends Controller
{
    public function create()
    {

        return View('orden_servicio.create');
        //
    }

    //
    public function store(OrdenServiciosRequest $request)
    {
        $orden_de_servicio = ordenservicios::create([
            'nombre' => $request->nombre,
            'documento' => $request->documento,
            'aseguradora_id' => (double) $request->aseguradora_id,
            'contrato' => $request->contrato
        ]);
        for ($i = 0; $i < count($request->cups); $i++){

            $total = ((double) $request->cantidad[$i] * (double) $request->valor_unitario[$i]) - (double) $request->copago[$i];
            OrdenServicio_Items::create([
                'id_orden_servicio' => $orden_de_servicio->id,
                'cups' => $request->cups[$i],
                'descripcion' => $request->descripcion[$i],
                'cantidad' => (double) $request->cantidad[$i],
                'copago' => (double) $request->copago[$i],
                'valor_unitario' => (double) $request->valor_unitario[$i],
                'valor_total' => $total
            ]);
        }
        return 'Orden registrada';
    }
}
