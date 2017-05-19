<?php

namespace App\Http\Controllers;
use App\Aseguradora;
use App\Empresa;
use App\Usuarios;
use App\Servicios;
use App\Diagnosticos;
use App\Manuales;
use App\Contratos;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $empresa = Empresa::find(1);
        return view('administracion.empresa.index',compact('empresa'));
    }

    public function aseguradoras(){
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.aseguradoras.index",$datos);
    }

    public function editaseguradora($id){
        $aseguradora = Aseguradora::findOrFail($id);         
        return view('administracion.aseguradoras.edit',compact('aseguradora'));  
    }

    public function diagnosticos(){
        $diagnosticos = Diagnosticos::paginate(5);
        $datos = ['diagnosticos' => $diagnosticos];
        return view("administracion.diagnosticos.index",$datos);
    }

    public function creatediagnosticos(){        
        return view('administracion.diagnosticos.create');}

    public function editdiagnosticos($id){
        $diagnosticos = Diagnosticos::findOrFail($id);        
        return view('administracion.diagnosticos.edit',compact('diagnosticos'));}

    public function usuarios(){
        $usuarios = Usuarios::all();
        $datosusuarios = ['usuarios' => $usuarios];
        return view("administracion.usuarios.index",$datosusuarios); 
    }

    public function createusuario(){        
        return view('administracion.usuarios.create'); }

    public function editusuarios($id){
        $usuarios = Usuarios::findOrFail($id);        
        return view('administracion.usuarios.edit',compact('usuarios'));}
    
}
