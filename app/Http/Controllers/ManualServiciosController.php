<?php

namespace App\Http\Controllers;

use App\Manuales;
use App\Manuales_servicios;
use App\Servicios;
use Illuminate\Http\Request;
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
        $servicios = Servicios::where("estado", "Activo")->orderBy("cups")->get();
        return view('administracion.manuales.servicios.create', compact('manual', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_manual, Request $request)
    {
        $manual = Manuales::findOrFail($id_manual);
        $this->validate($request, [
            'id_servicio' => 'required|exists:servicios,id',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required'
        ]);

        $manual_servicio = Manuales_servicios::where("id_manual", $id_manual)->where("id_servicio", $request->id_servicio)->get();

        if ($manual_servicio != "[]") {
            $manual_servicio = $manual_servicio[0];
            if ($request->ajax()) {
                return response()->json([
                    'error' => "EL servicio <a href='/manuales/$id_manual/servicios/$request->id_servicio/edit' target='_blank'><b>" . $manual_servicio->id_servicio->cups . "</b></a> ya se encuentra registrado en el manual <a href='/manuales/$id_manual' target='_blank'><b>" . $manual_servicio->id_manual->codigosoat . "</b></a>."
                ]);
            } else {
                flash("EL servicio <a href='/manuales/$id_manual/servicios/$request->id_servicio/edit' target='_blank'>" . $manual_servicio->id_servicio->cups . "</a> ya se encuentra registrado en el manual <a href='/manuales/$id_manual' target='_blank'>" . $manual_servicio->id_manual->codigosoat . "</a>.")->error();
                return Redirect::to("/manuales/$id_manual/servicios/create");
            }
        } else {
            $manual_servicio = Manuales_servicios::create([
                'id_servicio' => $request->id_servicio,
                'id_manual' => $id_manual,
                'costo' => $request->costo,
                'estado' => $request->estado
            ]);
            if ($request->ajax()) {
                return response()->json([
                    'success' => 'true',
                    'mensaje' => "El servicio <a href='/manuales/$id_manual/servicios/$request->id_servicio/edit' target='_blank'><b>" . $manual_servicio->id_servicio->cups . "</b></a> ha sido añadido al manual <a href='/manuales/$id_manual' target='_blank'><b>" . $manual_servicio->id_manual->codigosoat . "</b></a> con éxito!."
                ]);
            } else {
                flash("El servicio <a href='/manuales/$id_manual/servicios/$request->id_servicio/edit' target='_blank'>" . $manual_servicio->id_servicio->cups . "</a> ha sido añadido al manual <a href='/manuales/$id_manual' target='_blank'>" . $manual_servicio->id_manual->codigosoat . "</a> con éxito!.")->success();
                return Redirect::to("/manuales/$id_manual");
            }
        }

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
     * @param  int $id_manual
     * @param  int $id_manual_servicio
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id_manual, $id_manual_servicio, Request $request)
    {
        $manual_servicio = Manuales_servicios::findOrFail($id_manual_servicio);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'true',
                'manual_servicio' => $manual_servicio
            ]);
        } else {
            $servicios = Servicios::where("estado", "Activo")->orderBy("cups")->get();
            return view('administracion.manuales.servicios.edit', compact('manual_servicio', 'servicios'));
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id_manual
     * @param  int $id_manual_servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_manual, $id_manual_servicio)
    {
        $this->validate($request, [
            'id_servicio' => 'required|exists:servicios,id',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required'
        ]);
        $servicio = Servicios::findOrfail($request->id_servicio);
        $manual = Manuales::findOrfail($id_manual);
        $manual_servicio = Manuales_servicios::findOrFail($id_manual_servicio);
        if ($request->id_servicio != $manual_servicio->id_servicio->id) {
            $servicios = Manuales_servicios::where("id_manual", $id_manual)->where("id_servicio", $request->id_servicio)->get();

            if ($servicios != "[]") {
                $servicios = $servicios[0];
                if ($request->ajax()) {
                    return response()->json([
                        'error' => "El servicio <a href='/manuales/$id_manual/servicios/$servicios->id/edit' target='_blank'><b>" . $servicio->cups . "</b></a> ya se encuentra registrado en el manual <a href='/manuales/$id_manual' target='_blank'><b>" . $manual->codigosoat . "</b></a>"
                    ]);
                } else {
                    flash("El servicio <a href='/manuales/$id_manual/servicios/$servicios->id/edit' target='_blank'><b>" . $servicio->cups . "</b></a> ya se encuentra registrado en el manual <a href='/manuales/$id_manual' target='_blank'><b>" . $manual->codigosoat . "</b></a>")->error();
                    return Redirect::to("/manuales/$id_manual/servicios/$id_manual_servicio/edit");
                }
            } else {
                $manual_servicio->id_servicio = $request->id_servicio;
                $manual_servicio->costo = $request->costo;
                $manual_servicio->estado = $request->estado;
                $manual_servicio->save();
            }
        } else {
            $manual_servicio->costo = $request->costo;
            $manual_servicio->estado = $request->estado;
            $manual_servicio->save();
        }
        if ($request->ajax()) {
            return response()->json([
                'success' => 'true',
                'mensaje' => "El servicio <a href='/manuales/$id_manual/servicios/$id_manual_servicio/edit' target='_blank'><b>" . $servicio->cups . "</b></a> ha sido actualizado con éxito!."
            ]);
        } else {
            flash("El servicio <a href='/manuales/$id_manual/servicios/$id_manual_servicio/edit' target='_blank'><b>" . $servicio->cups . "</b></a> ha sido actualizado con éxito!.")->success();
            return Redirect::to("/manuales/$id_manual");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_manual
     * @param  int $id_manual_servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_manual, $id_manual_servicio,Request $request)
    {
        $manual_servicio = Manuales_servicios::findOrFail($id_manual_servicio);
        $cups = $manual_servicio->id_servicio->cups;

        if($manual_servicio->delete()){
            if ($request->ajax()) {
                return response()->json([
                    'success' => 'true',
                    'mensaje' => "EL servicio <b>$cups</b> ha sido eliminado con éxito!"
                ]);
            } else {
                flash("EL servicio <b>$cups</b> ha sido eliminado con éxito!")->success();
                return Redirect::to("/manuales/$id_manual");
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'error' => "Error al eliminar el servicio <b>$cups</b>."
                ]);
            } else {
                flash("Error al eliminar el servicio <b>$cups</b>.")->error();
                return Redirect::to("/manuales/$id_manual");
            }
        }

    }
}
