<?php

namespace App\Http\Controllers;
use App\Aseguradora;
use App\Empresa;
use App\Usuarios;
use App\servicios;
use App\Diagnosticos;
use App\Manuales;
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
            return view('administracion.aseguradoras.edit',compact('aseguradora'));  }
     
     
     
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
     
    
    public function servicios(){
    $servicios = Servicios::all();
    $datos = ['servicios' => $servicios];       
    return view("administracion.servicios.index",$datos);
    }
    
            public function editservicio($id){
            $servicios = Servicios::findOrFail($id);        
            return view('administracion.servicios.edit',compact('servicios'));}

            public function createservicio(){        
            return view('administracion.servicios.create');}


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

    public function contratos(){
    $aseguradoras = Aseguradora::paginate(5);
    $datos = ['aseguradoras' => $aseguradoras];
    return view("administracion.contratos.index",$datos);
    }

            public function createcontratos(){        
            return view('administracion.contratos.create');}

            public function editcontratos($id){
            $contratos = Contratos::findOrFail($id);        
            return view('administracion.contratos.edit',compact('contratos'));}


     
    public function manuales(){
    $manuales = Manuales::paginate(5);
       
        
    $datos = ['manuales' => $manuales];
    return view("administracion.manuales.index",$datos);

    }
            public function createmanuales(){  
             $servicios = Servicios::where('estado', 'Activo')->orderBy('cups')->get();
             $servicios = ['servicios' => $servicios];       
            return view('administracion.manuales.create',$servicios);}

            public function editmanuales($id){
            $manuales = Manuales::findOrFail($id);        
            return view('administracion.manuales.edit',compact('manuales'));}
    
    /**
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
