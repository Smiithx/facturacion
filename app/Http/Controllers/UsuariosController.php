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
    public function index(Request $request)
    {
        $usuarios = Usuarios::nombre($request->get('nombre'))->orderBy('id', 'DES')->paginate();
        $datosusuarios = ['usuarios' => $usuarios];
        return view("administracion.usuarios.index", $datosusuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buscar(Request $request)
    {
        if (trim($request) != "") {
            $usuarios = Usuarios::where('nombre', "LIKE", "%$request->nombre%")
                ->get();
            $datos = ['usuarios' => $usuarios];
            return view("administracion.usuarios.index", $datos);
        }

    }

    public function create()
    {
        return view('administracion.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
            'cargo' => 'required'
        ]);

        $firma = $request->file('firma');

        //obtenemos el nombre del archivo
        $nombre = $firma->getClientOriginalName();

        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre, \File::get($firma));

        $usuario = Usuarios::create($request->all());
        $usuario->firma = $nombre;
        $usuario->save();
        flash("El usuario <a href='/usuarios/$usuario->id/edit' target='_blank'>#$usuario->id</a> ha sido creado con éxito!")->success();
        return Redirect::to('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = Usuarios::findOrFail($id);
        return view('administracion.usuarios.edit', compact('usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuarios::findOrFail($id);
        if ($request->hasFile('firma')) {
            $firma = $request->file('firma');
            //obtenemos el nombre del archivo
            $nombre = $firma->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre, \File::get($firma));

            $usuario->fill($request->all());
            $usuario->firma = $nombre;
            $usuario->save();
            flash("El usuario <a href='/usuarios/$usuario->id/edit'>#$usuario->id</a> ha sido actualizado con éxito!")->success();
            return Redirect::to('/usuarios');
        } else {
            $usuario->fill($request->all());
            $usuario->save();
            flash("El usuario <a href='/usuarios/$usuario->id/edit'>#$usuario->id</a> ha sido actualizado con éxito!")->success();
            return Redirect::to('/usuarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuarios::findOrFail($id);
        $usuarios->delete();
        flash("El usuario #$id ha sido eliminado con éxito!")->success();
        return Redirect::to('/usuarios');
    }
}
