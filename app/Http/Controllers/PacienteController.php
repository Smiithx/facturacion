<?php

namespace App\Http\Controllers;

use App\Aseguradora;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
use Illuminate\Support\Facades\Redirect;

//use Illuminate\Support\Facades\DB;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        $pacientes = Paciente::name($request->get('name'))->orderBy('id','DES')->paginate();
        return View('pacientes.index',['pacientes'=>$pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aseguradoras = Aseguradora::all();
        $datos = ['aseguradoras' => $aseguradoras];
        return View('pacientes.create',$datos);
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
            'aseguradora_id' => 'required|integer',
            'contrato' => 'required|max:255'
        ]);
        $paciente = Paciente::create($request->all());
        $aseguradora = Aseguradora::find($request->get('aseguradora_id'));
        $aseguradora->pacientes()->save($paciente);

        return Redirect::to('pacientes');
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
        $paciente = Paciente::where("documento","=",$documento)->get();

        if($paciente != "[]"){
            return response()->json([
                'success' => 'true',
                'paciente' => $paciente[0]
            ]);
        }else{
            return response()->json([
                'error' => 'No existen pacientes con ese numero de documento'
            ]);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $aseguradoras = Aseguradora::all();
        $datos = ['paciente'=>$paciente, 'aseguradoras' => $aseguradoras];
        return view("pacientes.edit",$datos);
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
        $paciente = Paciente::findOrFail($id);
        $paciente->fill($request->all());
        $paciente->save();
        return Redirect::to("pacientes/$id/edit");
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
