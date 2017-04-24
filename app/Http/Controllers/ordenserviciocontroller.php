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
        'cups' => 'required|max:255',
        'copago' => 'required|numeric|min:0.01',
        'cantidad' => 'required|integer|min:1',
        'valor_unitario' => 'required|numeric|min:0.01',
        'valor_total' => 'required|numeric|min:0.01'

        ]);
        ordenservicios::create($request->all());
        return View('orden_servicio.create');    }
}
