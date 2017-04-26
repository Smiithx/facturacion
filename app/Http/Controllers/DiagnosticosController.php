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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
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
        $this->validate($request, [
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'estado' => 'required'            
        ]);
        $diagnostico = Diagnosticos::create($request->all());
        $diagnosticos = Diagnosticos::paginate(10);
        $datos = ['diagnosticos' => $diagnosticos];

   
        Session::flash('message',$diagnostico->descripcion.' Fue creada con exito');
        return Redirect::to('administracion/diagnosticos');
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
        $diagnosticos = Diagnosticos::findOrFail($id);

        $diagnosticos->fill($request->all());
        $diagnosticos->save();
        Session::flash('message',$diagnosticos->codigo.' Fue actualizado con exito');
        return Redirect::to('administracion/diagnosticos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnosticos = Diagnosticos::findOrFail($id);
        $diagnosticos->delete();
        Session::flash('message',$diagnosticos->codigo.' fue eliminado con Exito');
        return Redirect::to('administracion/diagnosticos');
    }
}
