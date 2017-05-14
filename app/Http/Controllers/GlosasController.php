<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Glosas;
use App\Factura;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GlosasController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("glosas.create");
    }

  public function createcontrato()
    {
      return view("glosas.createcontrato");
        
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
            'id_factura' => 'required|max:255',
            'valor_glosa' => 'required',
            'valor_aceptado' => 'required'            
        ]);

        $glosas = Glosas::create($request->all());
        
        flash('Glosas creada con exito!');
        return Redirect::to("/glosas/create");
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
        //
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


 public function buscar($factura, $desde, $hasta){
   
    $Facturas = Factura::where('id',$factura)
            ->orWhere('id_contrato', $factura)
            ->whereDate('created_at', '>=', $desde)
            ->whereDate('created_at', '<=', $hasta)->get();


            $glosas_tbody = "";
           
            foreach ($Facturas as $factura) {
$glosas_tbody .= "<tr>
         <td class='text-center'><a href='/facturas/$factura->id' target='_blank'>$factura->id</a></td> 
                    <input type='hidden'  name='id_factura' value='$factura->id'>

          <td>$factura->fecha_radicacion</td>
          <td>". number_format($factura->factura_total, 2) ."</td>
          <td><input style='width: 100%;' type='number' step='0.00' placeholder='Ingresar valor' name='valor_glosa' required></td>
          <td><input style='width: 100%;' type='number' step='0.00' placeholder='Ingresar valor' name='valor_aceptado' required></td>
           </tr>";
            }

           if ($glosas_tbody != "") {
                return response()->json([
                  'success' => 'true',
                    'glosas_tbody' => $glosas_tbody
               ]);
            } else {
                 return response()->json([
                     'error' => 'No se encontraron Facturas.'
                 ]);
             }
        
      }

}
