<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
//use Illuminate\Support\Facades\DB;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return View('pacientes.index',['pacientes'=>$pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return View('pacientes.create');
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
            'documento' => 'required|max:255',
            'nombre' => 'required|max:255',
            'edad' => 'required|integer|min:1',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required',
            'direccion' => 'required|max:255',
            'aseguradora' => 'required|max:255',
            'contrato' => 'required|max:255'
        ]);
        Paciente::create($request->all());
        $pacientes = Paciente::all();
        return View('pacientes.index',['pacientes'=>$pacientes]);
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
     * Display the specified resource.
     *
     * @param  String  $documento
     * @return \Illuminate\Http\Response
     */
    public function documento($documento)
    {

        $pacientes = Paciente::where("documento","=",$documento)->get()->toJson();

        //$pacientes = DB::table('pacientes')->where('documento', $documento)->first();

        dd($pacientes);
        
        
        return response()->json(['respuesta' => pacientes::all()]);


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
