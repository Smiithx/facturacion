<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contratos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function buscar(Request $request)
    {
        if (trim($request) != "") {
            $contratos = Contratos::where('contrato', "LIKE", "%$request->nombre%")
                ->get();
            $datos = ['contratos' => $contratos];
            return view("administracion.contratos.index", $datos);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'nit' => 'required',
            'diasvencimiento' => 'required|integer|min:1',
            'id_manual' => 'required',
            'porcentaje' => 'required|integer|min:1',
            'estado' => 'required'

        ]);
        $contrato = Contratos::create($request->all());

        Session::flash('message', $contrato->contrato . ' Fue Creada con exito');
        return Redirect::to('administracion/contratos');
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
        //
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

        $contratos = Contratos::findOrFail($id);
        $contratos->fill($request->all());
        $contratos->save();
        Session::flash('message', ' Fue actualizado con exito');
        return Redirect::to('administracion/contratos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contratos = Contratos::findOrFail($id);
        $contratos->delete();
        Session::flash('message', $contratos->id . ' fue eliminado con Exito');
        return Redirect::to('administracion/contratos');
    }
}
