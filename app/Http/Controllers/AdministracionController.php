<?php

namespace App\Http\Controllers;
use App\Aseguradora;
use App\Empresa;
use App\Usuarios;
use App\servicios;
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
    public function index()
    {
        $empresa = Empresa::find(1);

 return view('administracion.empresa.index',compact('empresa'));
    
    }

    public function usuarios(){
        $usuarios = Usuarios::all();
        $datosusuarios = ['usuarios' => $usuarios];
         return view("administracion.usuarios.index",$datosusuarios);
    }
    
      public function manuales(){
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.manuales.index",$datos);
    }
    
      public function aseguradoras(){
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.aseguradoras.index",$datos);
    }
     
      public function procedimientos(){
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.procedimientos.index",$datos);
    }
    
     
      public function medicamentos(){
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.medicamentos.index",$datos);
    }
    
      public function diagnosticos(){
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.diagnosticos.index",$datos);
    }
     public function servicios(){
         $servicios = Servicios::all();
        $datos = ['servicios' => $servicios];       
        return view("administracion.servicios.index",$datos);
    }
      public function plantillas(){
       
        return view("administracion.plantillas.index");
    }
    
     public function editaseguradora($id){
       $aseguradora = Aseguradora::findOrFail($id);
        
       return view('administracion.aseguradoras.edit',compact('aseguradora'));
    }
    
     public function editservicio($id){


       $servicios = Servicios::findOrFail($id);
        
       return view('administracion.servicios.edit',compact('servicios'));
    }

     public function createservicio(){
        
       return view('administracion.servicios.create');
    }

     public function createusuario(){
        
       return view('administracion.usuarios.create');
    }
    public function editusuarios($id){
       $usuarios = Usuarios::findOrFail($id);
        
       return view('administracion.usuarios.edit',compact('usuarios'));
    }
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
