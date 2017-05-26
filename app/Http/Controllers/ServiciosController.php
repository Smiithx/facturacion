<?php

namespace App\Http\Controllers;

use App\Contratos;
use App\Aseguradora;
use App\Manuales_servicios;
use Illuminate\Http\Request;
use App\Servicios;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ServiciosController extends Controller
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
        $servicios = Servicios::cups($request->get('cup'))->orderBy('id', 'DES')->paginate();
        $datos = ['servicios' => $servicios];
        return view("administracion.servicios.index", $datos);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.servicios.create');
    }

    public function buscar(Request $request)
    {
        if (trim($request) != "") {
            $servicios = Servicios::where('descripcion', "LIKE", "%$request->nombre%")
                ->get();
            $datos = ['servicios' => $servicios];
            return view("administracion.servicios.index", $datos);
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
            'cups' => 'required|max:255|unique:servicios,cups',
            'descripcion' => 'required|max:255',
            'estado' => 'required'
        ]);
        $servicio = Servicios::create($request->all());

        flash("EL servicio #<a href='/servicios/$servicio->id/edit' target='_blank'>$servicio->id</a> ha sido creado con éxito!")->success();
        return Redirect::to('/servicios');
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
        $servicio = Servicios::findOrFail($id);
        return view('administracion.servicios.edit', compact('servicio'));
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
        $servicio = Servicios::findOrFail($id);

        if (isset($request->cups)) {
            if ($servicio->cups != $request->cups) {
                $this->validate($request, [
                    'cups' => 'required|max:255|unique:servicios,cups',
                    'descripcion' => 'required|max:255',
                    'estado' => 'required'
                ]);
            } else {
                $this->validate($request, [
                    'descripcion' => 'required|max:255',
                    'estado' => 'required'
                ]);
            }
        } else {
            $this->validate($request, [
                'cups' => 'required|max:255'
            ]);
        }

        $servicio->fill($request->all());
        $servicio->save();
        flash("EL servicio #<a href='/servicios/$servicio->id/edit' target='_blank'>$servicio->id</a> ha sido modificado con éxito!")->success();
        return Redirect::to('/servicios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicios = Servicios::findOrFail($id);
        $servicios->delete();
        flash("EL servicio #$id ha sido eliminado con éxito!")->success();
        return Redirect::to('/servicios');

    }

    public function cups($cups, $contrato)
    {
        //try {
            $contrato = Contratos::findOrFail($contrato);

            // ---- Validar estado del contrato ----- //
            if ($contrato->estado == "Activo") {
                // ---- Validar estado del manual ----- //
                if ($contrato->id_manual->estado == "Activo") {
                    // ---- Validar existencia del servicio ----- //
                    $servicio = Servicios::where("cups", "=", $cups)->get();
                    if ($servicio != "[]") {
                        // ---- Validar estado del servicio ----- //
                        if ($servicio[0]->estado == "Activo") {
                            $manual_servicios = Manuales_servicios::where("id_manual", $contrato->id_manual->id)->where("id_servicio", $servicio[0]->id)->get();
                            // ---- Validar existencia del servicio en el contrato ----- //
                            if ($manual_servicios != "[]") {
                                $manual_servicios = $manual_servicios[0];
                                $precio = $manual_servicios->costo * $contrato->porcentaje / 100.00;
                                return response()->json([
                                    'success' => 'true',
                                    'manual_servicios' => $manual_servicios,
                                    'precio' => $precio
                                ]);
                            } //---- Fin de validar la existencia del servicio en el manual----- //
                            else{
                                return response()->json([
                                    'error' => "El servicio no se encuentra disponible para este contrato."
                                ]);
                            }
                        }  //---- Fin de validar estado del servicio ----- //
                        else {
                            return response()->json([
                                'error' => "El servicio se encuentra desactivado"
                            ]);
                        }
                    } //---- Fin de validar la existencia del servicio ----- //
                    else {
                        return response()->json([
                            'error' => "No existe el servicio con el código $cups"
                        ]);
                    }
                } //---- Fin de validar estado del manual ----- //
                else {
                    return response()->json([
                        'error' => "El manual se encuentra desactivado"
                    ]);
                }
            } //---- Fin de validar estado del contrato ----- //
            else {
                return response()->json([
                    'error' => 'El contrato se encuentra desactivado.'
                ], 200);
            }
        /*} catch (\Exception $e) {
            return response()->json(['error' => 'Contrato desconocido.'], 200);
        }*/
    }

}

