<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnosticos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DiagnosticosController extends Controller
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
        $diagnosticos = Diagnosticos::codigo($request->get('codigo'))->paginate(10);
        $datos = ['diagnosticos' => $diagnosticos,"codigo"=>$request->get('codigo')];
        return view("administracion.diagnosticos.index", $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.diagnosticos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:255|unique:diagnosticos,codigo',
            'descripcion' => 'required|max:255',
            'estado' => 'required'            
        ]);
        $diagnostico = Diagnosticos::create($request->all());
   
        flash("El diagnostico '<a href='/diagnosticos/$diagnostico->id/edit'><b>$diagnostico->codigo</b></a>' ha sido creado con éxito")->success();
        return Redirect::to('/diagnosticos');
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
        $diagnosticos = Diagnosticos::findOrFail($id);
        return view('administracion.diagnosticos.edit', compact('diagnosticos'));
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

        $diagnostico = Diagnosticos::findOrFail($id);

        if(isset($request->codigo)){
            if($diagnostico->codigo != $request->codigo){
                $this->validate($request, [
                    'codigo' => 'required|max:255|unique:diagnosticos,codigo',
                    'descripcion' => 'required|max:255',
                    'estado' => 'required'
                ]);
            }else{
                $this->validate($request, [
                    'codigo' => 'required|max:255',
                    'descripcion' => 'required|max:255',
                    'estado' => 'required'
                ]);
            }
        }else{
            $this->validate($request, [
                'codigo' => 'required|max:255|unique:diagnosticos,codigo'
            ]);
        }

        $diagnostico->fill($request->all());
        $diagnostico->save();
        flash("El diagnostico '<a href='/diagnosticos/$diagnostico->id/edit'><b>$diagnostico->codigo</b></a>' ha sido actualizado con éxito")->success();
       return Redirect::to('/diagnosticos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnostico = Diagnosticos::findOrFail($id);
        $codigo=$diagnostico->codigo;
        $diagnostico->delete();
        flash("El diagnostico '<b>$diagnostico->codigo</b>' ha sido eliminado con éxito")->success();
        return Redirect::to('/diagnosticos');
    }
}
