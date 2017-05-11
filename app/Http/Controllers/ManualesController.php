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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

      public function buscar(Request $request)
    {
            if(trim($request) != ""){    
              $manuales = Manuales::where('codigosoat',"LIKE","%$request->nombre%")
                 ->get();
                $datos = ['manuales' => $manuales];
               return view("administracion.manuales.index",$datos);
    }   }

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
            'tipomanual' => 'required',
            'servicios_id' => 'required',
            'tipomanual' => 'required',
            'codigosoat' => 'required',
            'costo' => 'required|numeric|min:0.01',
            'estado' => 'required'            
        ]);
        $manual = Manuales::create($request->all());
         
   
        Session::flash('message',' Fue creada con exito');
        return Redirect::to('administracion/manuales');
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
         $manuales = Manuales::findOrFail($id);

        $manuales->fill($request->all());
        $manuales->save();
        Session::flash('message',' Fue actualizado con exito');
        return Redirect::to('administracion/manuales');

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
        Session::flash('message',$manuales->id.' fue eliminado con Exito');
        return Redirect::to('administracion/manuales');
    }
}
