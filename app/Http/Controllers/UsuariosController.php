<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = User::name($request->get('name'))->orderBy('id', 'DES')->paginate();
        $datosusuarios = ['usuarios' => $usuarios, "name" => $request->get('name')];
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
            $usuarios = User::where('nombre', "LIKE", "%$request->nombre%")
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'documento' => 'required|max:50',
            'firma' => 'max:100',
            'cargo' => 'required'
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'documento' => $request->documento,
            'cargo' => $request->cargo
        ]);

        if ($request->hasFile('firma')) {
            $firma = $request->file('firma');

            //obtenemos el nombre del archivo
            $nombre = $firma->getClientOriginalName();

            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre, \File::get($firma));

            $usuario->firma = $nombre;
            $usuario->save();
        }

        flash("El usuario <a href='/usuarios/$usuario->id/edit' target='_blank'><b>$usuario->name</b></a> ha sido creado con éxito!")->success();
        return Redirect::to('/usuarios');
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
        $usuarios = User::findOrFail($id);
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
        $usuario = User::findOrFail($id);


        if (isset($request->email)) {
            if ($usuario->email != $request->email) {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'documento' => 'required|max:50',
                    'firma' => 'max:100',
                    'cargo' => 'required'
                ]);
            } else {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'documento' => 'required|max:50',
                    'firma' => 'max:100',
                    'cargo' => 'required'
                ]);
            }
        } else {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'documento' => 'required|max:50',
                'firma' => 'max:100',
                'cargo' => 'required'
            ]);
        }

        if ($request->hasFile('firma')) {
            $firma = $request->file('firma');
            //obtenemos el nombre del archivo
            $nombre = $firma->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre, \File::get($firma));

            $usuario->fill($request->all());
            $usuario->firma = $nombre;
            $usuario->save();
            flash("El usuario <a href='/usuarios/$usuario->id/edit'><b>$usuario->name</b></a> ha sido actualizado con éxito!")->success();
            return Redirect::to('/usuarios');
        } else {
            $usuario->fill($request->all());
            $usuario->save();
            flash("El usuario <a href='/usuarios/$usuario->id/edit'><b>$usuario->name</b></a> ha sido actualizado con éxito!")->success();
            return Redirect::to('/usuarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        try {
            if ($usuario->delete()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => 'true',
                        'mensaje' => "El usuario <b>$usuario->name</b> ha sido eliminado con éxito!"
                    ]);
                } else {
                    flash("El usuario <b>$usuario->name</b> ha sido eliminado con éxito!")->success();
                    return Redirect::to('/usuarios');
                }
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'error' => "Error al eliminar el usuario <b>$usuario->name</b>."
                    ]);
                } else {
                    flash("Error al eliminar el usuario <b>$usuario->name</b>.")->error();
                    return Redirect::to('/usuarios');
                }
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => "Error al eliminar el usuario <b>$usuario->name</b>."
                ]);
            } else {
                flash("Error al eliminar el usuario <b>$usuario->name</b>.")->error();
                return Redirect::to('/usuarios');
            }
        }
    }
}
