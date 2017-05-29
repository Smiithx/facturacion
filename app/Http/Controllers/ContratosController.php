<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contratos;
use App\Manuales;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContratosController extends Controller
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
        $contratos = Contratos::nombre($request->get('nombre'))->orderBy('id', 'DES')->paginate(10);
        $datos = ['contratos' => $contratos, "nombre" => $request->get('nombre')];
        return view("administracion.contratos.index",$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manuales = Manuales::where('estado', 'Activo')->orderBy('codigosoat')->get();
        $manuales = ['manuales' => $manuales];       
        return view('administracion.contratos.create',$manuales);
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
            'nombre' => 'required|max:255|unique:contratos,nombre',
            'nit' => 'required',
            'diasvencimiento' => 'required|integer|min:0',
            'id_manual' => 'required|exists:manuales,id',
            'porcentaje' => 'required|numeric|min:0',
            'estado' => 'required'
        ]);
        $contrato = Contratos::create($request->all());

        flash("EL contrato #<a href='/contratos/$contrato->id/edit' target='_blank'>$contrato->id</a> ha sido creado con éxito!")->success();
        return Redirect::to('/contratos');
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
        $manuales = Manuales::where('estado', 'Activo')->orderBy('codigosoat')->get(); 
        $contrato = Contratos::findOrFail($id);        
        return view('administracion.contratos.edit',compact('contrato','manuales'));
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
        $contrato = Contratos::findOrFail($id);
        if(isset($request->nombre)){
            if($contrato->nombre != $request->nombre){
                $this->validate($request, [
                    'nombre' => 'required|max:255|unique:contratos,nombre',
                    'nit' => 'required',
                    'diasvencimiento' => 'required|integer|min:0',
                    'id_manual' => 'required|exists:manuales,id',
                    'porcentaje' => 'required|numeric|min:0',
                    'estado' => 'required'
                ]);
            }else{
                $this->validate($request, [
                    'nit' => 'required',
                    'diasvencimiento' => 'required|integer|min:0',
                    'id_manual' => 'required|exists:manuales,id',
                    'porcentaje' => 'required|numeric|min:0',
                    'estado' => 'required'
                ]);
            }
        }else{
            $this->validate($request, [
                'nombre' => 'required|max:255|unique:contratos,nombre'
            ]);
        }
        
        $contrato->fill($request->all());
        $contrato->save();
        
        flash("EL contrato #<a href='/contratos/$contrato->id/edit' target='_blank'>$contrato->id</a> ha sido modificado con éxito!")->success();
        return Redirect::to('/contratos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato = Contratos::findOrFail($id);
        $contrato->delete();
        flash("EL contrato #$id ha sido eliminado con éxito!")->success();
        return Redirect::to('/contratos');
    }
}
