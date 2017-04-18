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
        'aseguradora' => 'required|max:255',
        'contrato' => 'required|max:255',
        'Cups' => 'required|max:255',
        'Copago' => 'required|integer|min:1',
        'Cantidad' => 'required|integer|min:1',
        'Valorunitario' => 'required|integer|min:1',
        'Valortotal' => 'required|integer|min:1'

        ]);
        ordenservicios::create($request->all());
        return View('orden_servicio.create');    }
}
