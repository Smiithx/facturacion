<?php

namespace App\Http\Controllers;

use App\Aseguradora;
use App\Contratos;
use App\ordenservicios;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

//use Illuminate\Support\Facades\DB;


class PacienteController extends Controller
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
        $pacientes = Paciente::name($request->get('name'))->orderBy('id', 'DES')->paginate();
        return View('pacientes.index', ['pacientes' => $pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aseguradoras = Aseguradora::all();
        $contratos = Contratos::all();
        $datos = ['aseguradoras' => $aseguradoras, 'contratos' => $contratos];
        return View('pacientes.create', $datos);
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
            'documento' => 'required|max:255|unique:pacientes,documento',
            'nombre' => 'required|max:255',
            'edad' => 'required|integer|min:1',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required',
            'direccion' => 'required|max:255',
            'aseguradora_id' => 'required|exists:aseguradoras,id',
            'id_contrato' => 'required|exists:contratos,id'
        ]);
        $paciente = Paciente::create($request->all());
        $aseguradora = Aseguradora::find($request->get('aseguradora_id'));
        $aseguradora->pacientes()->save($paciente);
        flash('El paciente ha sido registrado con exito!');
        return Redirect::to('pacientes/create');
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
     * Display the specified resource.
     *
     * @param  String $documento
     * @return \Illuminate\Http\Response
     */
    public function documento($documento)
    {
        $paciente = Paciente::where("documento", "=", $documento)->get();

        if ($paciente != "[]") {
            return response()->json([
                'success' => 'true',
                'paciente' => $paciente[0]
            ]);
        } else {
            return response()->json([
                'error' => 'No existen pacientes con ese numero de documento'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $aseguradoras = Aseguradora::all();
        $contratos = Contratos::all();
        $datos = ['paciente' => $paciente, 'aseguradoras' => $aseguradoras, 'contratos' => $contratos];
        return view("pacientes.edit", $datos);
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
        $paciente = Paciente::findOrFail($id);
        $paciente->fill($request->all());
        $paciente->save();
        flash('Los datos han sido actualizados con éxito!')->success();
        return Redirect::to("pacientes/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $ordenes = ordenservicios::where("id_paciente", $paciente->id)->get();
        if (count($ordenes) == 0) {
            try {
                if ($paciente->delete()) {
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => 'true',
                            'mensaje' => "El paciente <b>$paciente->nombre</b> ha sido eliminado con éxito!"
                        ]);
                    } else {
                        flash("El paciente <b>$paciente->nombre</b> ha sido eliminado con éxito!")->success();
                        return Redirect::to('/pacientes');
                    }
                } else {
                    if ($request->ajax()) {
                        return response()->json([
                            'error' => "Error al eliminar el paciente <b>$paciente->nombre</b>."
                        ]);
                    } else {
                        flash("Error al eliminar el paciente <b>$paciente->nombre</b>.")->error();
                        return Redirect::to('/pacientes');
                    }
                }
            } catch (\Exception $e) {
                if ($request->ajax()) {
                    return response()->json([
                        'error' => "Error al eliminar el paciente <b>$paciente->nombre</b>."
                    ]);
                } else {
                    flash("Error al eliminar el paciente <b>$paciente->nombre</b>.")->error();
                    return Redirect::to('/pacientes');
                }
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'error' => "No se puede eliminar el paciente <b>$paciente->nombre</b> debido a que existen ordenes de servicios asociadas a este."
                ]);
            } else {
                flash("No se puede eliminar el paciente <b>$paciente->nombre</b> debido a que existen ordenes de servicios asociadas a este.")->error();
                return Redirect::to('/pacientes');
            }
        }
    }
}
