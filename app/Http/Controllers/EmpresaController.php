<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;



class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
              $empresa = Empresa::find(1);

 return view('administracion.empresa.index',compact('empresa'));
        
        
       
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
        //
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
//si esta instanciado el input file 2 hace este bloque que solo actualiza el logo
if($request->hasFile('file')){

        //obtenemos el campo file definido en el formulario
       $file = $request->file('file');
 
       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
 
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put($nombre,  \File::get($file));

    
       $empresa = Empresa::findOrFail($id);
       $empresa->fill($request->all());
       $empresa->file = $nombre;
       $empresa->save();
       Session::flash('message',' Empresa Fue actualizado con exito');
        return Redirect::to('administracion');   


}

    // del resto actualiza todo
    else{
          $empresa = Empresa::findOrFail($id);
        
        $empresa->fill($request->all());
          $empresa->save();
       Session::flash('message',' Empresa fue  actualizado con exito');
    return Redirect::to('administracion');   


    }

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
