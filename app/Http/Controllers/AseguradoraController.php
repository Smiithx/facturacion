<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aseguradora;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AseguradoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

 if(trim($request) != ""){    
      $aseguradoras = Aseguradora::where('nombre',"LIKE","%$request->name%")
       ->paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];
        return view("administracion.aseguradoras.index",$datos);
    }
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
            'nombre' => 'required|max:255',
            'nit' => 'required|max:255',
            'estado' => 'required'            
        ]);
        $aseguradora = Aseguradora::create($request->all());
        $aseguradoras = Aseguradora::paginate(5);
        $datos = ['aseguradoras' => $aseguradoras];


        Session::flash('message',$aseguradora->nombre.' Fue Creada con exito');
        return Redirect::to('administracion/aseguradoras');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aseguradora=Aseguradora::find($id);

        if($aseguradora != null){
            return response()->json([
                'success' => 'true',
                'aseguradora' => $aseguradora
            ]);
        }else{
            return response()->json([
                'error' => 'No existe una aseguradora asociada al id'
                
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

        dd("probando ruta");
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

        $aseguradora = Aseguradora::findOrFail($id);

        $aseguradora->fill($request->all());
        $aseguradora->save();
        Session::flash('message',$aseguradora->nombre.' Fue actualizado con exito');
        return Redirect::to('administracion/aseguradoras');

    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aseguradora = Aseguradora::findOrFail($id);
        $aseguradora->delete();
        Session::flash('message',$aseguradora->nombre.' fue eliminado con Exito');
        return Redirect::to('administracion/aseguradoras');


    }


}
