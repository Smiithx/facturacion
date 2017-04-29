<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ordenservicios;

class ordenserviciocontroller extends Controller
{
    public function create()
    {

        return View('orden_servicio.create');
        //
    }

    //
    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|max:255',
            'documento' => 'required|max:255',
            'aseguradora_id' => 'required',
            'contrato' => 'required|max:255',
        ]);
        $count = count($request->cups);
        for ($i = 0; $i < $count; $i++) {
            $this->validate($request->cups[$i], [
                'cups' => 'required|max:255'
            ]);
            $this->validate($request->copago[$i], [
                'copago' => 'required|numeric|min:0.01'
            ]);
            $this->validate($request->valor_unitario[$i], [
                'valor_unitario' => 'required|numeric|min:0.01'
            ]);
            $this->validate($request->valor_total[$i], [
                'valor_total' => 'required|numeric|min:0.01'
            ]);
        }
        dd($request->all(), $request->cups, $request->copago, $request->valor_unitario, $request->valor_total);

        ordenservicios::create($request->all());
        return View('orden_servicio.create');
    }
}
