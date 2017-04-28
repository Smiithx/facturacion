<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicios;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;



class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $servicios = Aseguradora::paginate(5);
        $servicios = ['servicios' => $servicios];
        return view("administracion.servicios",$servicios);
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
            'cups' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'estado' => 'required'            
        ]);
        $servicio = Servicios::create($request->all());
        $servicios = Servicios::all();
        $datos = ['servicios' => $servicios];

   
        Session::flash('message',$servicio->descripcion.' Fue creada con exito');
        return Redirect::to('administracion/servicios');
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
        $servicios = Servicios::findOrFail($id);

        $servicios->fill($request->all());
        $servicios->save();
        Session::flash('message',$servicios->descripcion.' Fue actualizado con exito');
        return Redirect::to('administracion/servicios');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $servicios = Servicios::findOrFail($id);
        $servicios->delete();
        Session::flash('message',$servicios->descripcion.' fue eliminado con Exito');
        return Redirect::to('administracion/servicios');

    }

    public function cups($cups)
    {
        $servicio=Servicios::where("cups","=",$cups)->get();
        if($servicio != "[]"){
            return response()->json([
                'success' => 'true',
                'servicio' => $servicio[0]
            ]);
        }else{
            return response()->json([
                'error' => "No existe el servicio con el codigo $cups"
            ]);
        }
    }
}
