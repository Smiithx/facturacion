<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return "Orden de servicio registrada";
    }
}
