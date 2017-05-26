<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Manuales;
use App\Servicios;
use App\Manuales_servicios;
use Illuminate\Support\Facades\Redirect;

class ManualServiciosController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $manual = Manuales::findOrFail($id);
        $servicios = Servicios::where("estado","Activo")->orderBy("cups")->get();
        return view('administracion.manuales.servicios.create',compact('manual','servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_manual,Request $request)
    {
        $manual = Manuales::findOrFail($id_manual);
        $this->validate($request, [
            'id_servicio' => 'required|exists:servicios,id',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required'            
        ]);

        $manual_servicio = Manuales_servicios::where("id_manual",$id_manual)->where("id_servicio",$request->id_servicio)->get();

        if($manual_servicio !=  "[]"){
            $manual_servicio = $manual_servicio[0];
            flash("EL servicio <a href='/manuales/$id_manual/servicios/$request->id_servicio/edit' target='_blank'>".$manual_servicio->id_servicio->cups."</a> ya se encuentra registrado en el manual <a href='/manuales/$id_manual' target='_blank'>".$manual_servicio->id_manual->codigosoat."</a>.")->error();
            return Redirect::to("/manuales/$id_manual/servicios/create");
        }else{
            $manual_servicio = Manuales_servicios::create([
                'id_servicio' => $request->id_servicio,
                'id_manual' => $id_manual,
                'costo' => $request->costo,
                'estado' => $request->estado  

            ]);
            
            flash("El servicio <a href='/manuales/$id_manual/servicios/$request->id_servicio/edit' target='_blank'>".$manual_servicio->id_servicio->cups."</a> ha sido añadido al manual <a href='/manuales/$id_manual' target='_blank'>".$manual_servicio->id_manual->codigosoat."</a> con éxito!.")->success();
            return Redirect::to("/manuales/$id_manual");
        }
        
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
    public function edit($id_manual,$id_manual_servicio)
    {
        $manual_servicio = Manuales_servicios::findOrFail($id_manual_servicio);
        $servicios = Servicios::where("estado","Activo")->orderBy("cups")->get();

        return view('administracion.manuales.servicios.edit',compact('manual_servicio','servicios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_manual,$id_manual_servicio)
    {
        $this->validate($request, [
            'id_servicio' => 'required|exists:servicios,id',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required'
        ]);
        $servicio = Servicios::findOrfail($request->id_servicio);
        $manual = Manuales::findOrfail($id_manual);
        $manual_servicio = Manuales_servicios::findOrFail($id_manual_servicio);
        if($request->id_servicio != $manual_servicio->id_servicio->id){

            $servicios = Manuales_servicios::where("id_manual",$id_manual)->where("id_servicio",$request->id_servicio)->get();

            if($servicios != "[]"){

                $servicios = $servicios[0];
                flash("El servicio <a href='/manuales/$id_manual/servicios/$servicios->id/edit' target='_blank'>".$servicio->cups."</a> ya se encuentra registrado en el manual <a href='/manuales/$id_manual' target='_blank'>".$manual->codigosoat."</a>")->error();
                return Redirect::to("/manuales/$id_manual/servicios/$id_manual_servicio/edit");
            }else{
                $manual_servicio->id_servicio = $request->id_servicio;
                $manual_servicio->costo = $request->costo;
                $manual_servicio->estado = $request->estado;
                $manual_servicio->save();
            }
        }else{
            $manual_servicio->costo = $request->costo;
            $manual_servicio->estado = $request->estado;
            $manual_servicio->save();
        }
        flash("El servicio <a href='/manuales/$id_manual/servicios/$id_manual_servicio/edit' target='_blank'>".$servicio->cups."</a> fue actualizado con éxito!.")->success();
        return Redirect::to("/manuales/$id_manual");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_manual,$id_manual_servicio)
    {
        $manual_servicio = Manuales_servicios::findOrFail($id_manual_servicio);
        $cups = $manual_servicio->id_servicio->cups;
        $manual_servicio->delete();

        flash("EL servicio $cups ha sido eliminado con éxito!")->success();
        return Redirect::to("/manuales/$id_manual");
    }
}
