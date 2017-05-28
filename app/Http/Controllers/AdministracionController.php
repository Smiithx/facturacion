<?php

namespace App\Http\Controllers;

use App\Aseguradora;
use App\Empresa;
use App\User;
use App\Servicios;
use App\Diagnosticos;
use App\Manuales;
use App\Contratos;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministracionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::find(1);
        return view('administracion.empresa.index', compact('empresa'));
    }
    public function creatediagnosticos()
    {

    }

    public function editdiagnosticos($id)
    {

    }

}
