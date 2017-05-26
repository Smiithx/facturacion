<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manuales;
use App\Servicios;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ManualesController extends Controller
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
        $manuales = Manuales::soat($request->get('soat'))->orderBy('id', 'DES')->paginate();
        $manuales = ['manuales' => $manuales];
        return view("administracion.manuales.index",$manuales);
    }

    public function buscar(Request $request)
    {
        if(trim($request) != ""){    
            $manuales = Manuales::where('codigosoat',"LIKE","%$request->nombre%")
                ->get();
            $datos = ['manuales' => $manuales];
            return view("administracion.manuales.index",$datos);
        }
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('administracion.manuales.create');
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
            'tipo' => 'required',
            'codigosoat' => 'required',
            'estado' => 'required'            
        ]);
        $manual = Manuales::create($request->all());

        flash("EL manual #<a href='/manuales/$manual->id/edit' target='_blank'>$manual->id</a> ha sido creado con éxito!")->success();
        return Redirect::to('/manuales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $manual = Manuales::findOrFail($id);
        $servicios = Servicios::manualCups($request->get('cup'),$id)
            ->paginate();
        return view('administracion.manuales.show',compact('manual','servicios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manual = Manuales::findOrFail($id);
        return view('administracion.manuales.edit',["manual" => $manual]);
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
        $manual = Manuales::findOrFail($id);

        $manual->fill($request->all());
        $manual->save();

        flash("EL manual #<a href='/manuales/$manual->id/edit' target='_blank'>$manual->id</a> ha sido modificado con éxito!")->success();
        return Redirect::to('/manuales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manuales = Manuales::findOrFail($id);
        $manuales->delete();

        flash("EL manual #$id ha sido eliminado con éxito!")->success();
        return Redirect::to('/manuales');
    }

    public function cups($cups,$contrato){

    }

}
