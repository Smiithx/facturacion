<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $usuarios = Usuarios::paginate(5);
        $datosusuarios = ['usuarios' => $usuarios];
         return view("administracion.usuarios.index",$datosusuarios);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function buscar(Request $request)
    {
            if(trim($request) != ""){    
              $usuarios = Usuarios::where('nombre',"LIKE","%$request->nombre%")
                 ->get();
                $datos = ['usuarios' => $usuarios];
               return view("administracion.usuarios.index",$datos);
    }   
        
    }
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
    /*QUEDE AQUI DOMINGO FALTA ENCRIPTAR LA CONTRASEÑA*/
    public function store(Request $request)
    {
      
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'documento' => 'required|max:255',
            'contraseña' => 'required',
            'confirm_contraseña' => 'required|same:contraseña',
            'firma' => 'required|max:255',
            'cargo' => 'required'


        ]);
      
       $usuarios = Usuarios::create($request->all());
        Session::flash('message',$usuarios->nombre.' Fue Creado con exito');
        return Redirect::to('administracion/usuarios');


        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    }
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
        
        $usuarios = Usuarios::findOrFail($id);

        $usuarios->fill($request->all());
        $usuarios->save();
        Session::flash('message',$usuarios->nombre.' Fue actualizado con exito');
        return Redirect::to('administracion/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $usuarios = Usuarios::findOrFail($id);
        $usuarios->delete();
        Session::flash('message',$usuarios->nombre.' fue eliminado con Exito');
        return Redirect::to('administracion/usuarios');
    }
}
