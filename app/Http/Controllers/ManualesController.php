<?php

namespace App\Http\Controllers;

use App\Contratos;
use App\Manuales;
use App\Manuales_servicios;
use App\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $manuales = Manuales::nombre($request->get('nombre'))->orderBy('id', 'DES')->paginate();
        $servicios = Servicios::where("estado","Activo")->orderBy("cups")->get();
        $manuales = ['manuales' => $manuales, "nombre" => $request->get('nombre'),"servicios" => $servicios];
        return view("administracion.manuales.index", $manuales);
    }

    public function buscar(Request $request)
    {
        if (trim($request) != "") {
            $manuales = Manuales::where('nombre', "LIKE", "%$request->nombre%")
                ->get();
            $datos = ['manuales' => $manuales];
            return view("administracion.manuales.index", $datos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $servicios = Servicios::where("estado", "Activo")->orderBy("cups")->get();
        return view('administracion.manuales.create', compact('servicios'));
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
            'nombre' => 'required',
            'estado' => 'required'

        ]);
        $manuales = Manuales::where("nombre","LIKE","$request->nombre")->get();
        if (count($manuales) >= 1 ) {

            flash("EL Manual ".$request->nombre." ya se encuentra Creado!")->error();
            $servicios = Servicios::where("estado", "Activo")->orderBy("cups")->get();
            return view('administracion.manuales.create', compact('servicios'));        }
        else{


        $manual = Manuales::create($request->all());
        flash("EL manual #<a href='/manuales/$manual->id/edit' target='_blank'>$manual->id</a> ha sido creado con éxito!")->success();
        return Redirect::to('/manuales');

        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            try {
                $manual = Manuales::findOrFail($id);

                $total_results = count(Servicios::manualCups($request->cup, $id)->get());

                if ($request->page == 1) {
                    $inicio = 0;
                } else {
                    $inicio = ($request->page - 1) * $request->limit_results;
                }

                $servicios = Servicios::manualCups($request->cup, $id)
                    ->offset($inicio)
                    ->limit($request->limit_results)
                    ->get();

                return response()->json([
                    'success' => true,
                    'servicios' => $servicios,
                    'total_results' => $total_results
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }
        } else {
            $manual = Manuales::findOrFail($id);
            $servicios = Servicios::manualCups($request->get('cup'), $id)
                ->paginate();
            return view('administracion.manuales.show', compact('manual', 'servicios'));
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
        $manual = Manuales::findOrFail($id);
        return view('administracion.manuales.edit', ["manual" => $manual]);
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
        $manual = Manuales::findOrFail($id);

        $manual->fill($request->all());
        $manual->save();

        flash("EL manual #<a href='/manuales/$manual->id/edit' target='_blank'>$manual->id</a> ha sido modificado con éxito!")->success();
        return Redirect::to('/manuales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manuales = Manuales::findOrFail($id);
        $nombre = $manuales->codigosoat;
        $contrato = Contratos::where("id_manual", $id)->get();
        $numero_contrato = count($contrato);

        if ($numero_contrato > 0) {
            flash("El manual '<b>$nombre</b>' no se puede eliminar porque tiene contratos asociados")->error();
            return Redirect::to('/manuales');
        }
        $manuales_servicios = Manuales_servicios::where("id_manual", $id)->get();

        foreach ($manuales_servicios as $manuale_servicio) {
            $manuale_servicio->delete();
        }

        $manuales->delete();
        flash("El manual '<b>$nombre</b>' ha sido eliminado")->success();
        return Redirect::to('/manuales');

    }

    public function cups($cups, $contrato)
    {

    }

}
