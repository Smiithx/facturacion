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
             $contratos = Contratos::select("contratos.id","contratos.id_manual","contratos.contrato","contratos.nombre","contratos.nit","contratos.diasvencimiento","manuales.codigosoat","contratos.porcentaje","contratos.estado")
             ->join("manuales","contratos.id_manual","=","manuales.id")        
              ->get();
             $datos = ['contratos' => $contratos];
             return view("administracion.contratos.index",$datos);
    }

            public function createcontratos(){  
             $manuales = Manuales::where('estado', 'Activo')->orderBy('codigosoat')->get();
             $manuales = ['manuales' => $manuales];       
            return view('administracion.contratos.create',$manuales);}

            public function editcontratos($id){
            $manuales = Manuales::lists('codigosoat', 'id'); /* aqui le paso los datos que quiero que muestre y el que quiero que inserte*/   
            $contratos = Contratos::findOrFail($id);        
            return view('administracion.contratos.edit',compact('contratos','manuales'));}


     
    public function manuales(){ 
             $manuales = Manuales::select("manuales.id","manuales.tipomanual","servicios.cups","manuales.codigosoat", "manuales.costo", "manuales.estado")
            ->join("servicios","manuales.servicios_id","=","servicios.id")        
            ->get();
             $manuales = ['manuales' => $manuales];
             return view("administracion.manuales.index",$manuales);

    }
            public function createmanuales(){  
             $servicios = Servicios::where('estado', 'Activo')->orderBy('cups')->get();
             $servicios = ['servicios' => $servicios];       
            return view('administracion.manuales.create',$servicios);}

            public function editmanuales($id){
            $manuales = Manuales::findOrFail($id);             
            $servicios = Servicios::lists('cups', 'id'); /* aqui le paso los datos que quiero que muestre y el que quiero que inserte*/   
            return view('administracion.manuales.edit',compact('manuales','servicios'));}
    
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
