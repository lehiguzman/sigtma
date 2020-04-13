<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoContribuyenteVehiculo;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $tiposVehiculo = TipoContribuyenteVehiculo::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $tiposVehiculo = TipoContribuyenteVehiculo::find($request->id);                
        }    
        return [ 
            'tipos_vehiculo' => $tiposVehiculo
        ];
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $tipoContribuyenteVehiculo = new TipoContribuyenteVehiculo();        
        
        $tipoContribuyenteVehiculo->tipo = $request->tipo;        
        $tipoContribuyenteVehiculo->descripcion = $request->descripcion;
        $tipoContribuyenteVehiculo->monto_ut = $request->monto_ut;        
        $tipoContribuyenteVehiculo->save();        
    } 

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        $tipoContribuyenteVehiculo = TipoContribuyenteVehiculo::findOrFail($request->id);        
        $tipoContribuyenteVehiculo->tipo = $request->tipo;        
        $tipoContribuyenteVehiculo->descripcion = $request->descripcion;
        $tipoContribuyenteVehiculo->monto_ut = $request->monto_ut;        
        $tipoContribuyenteVehiculo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {        
        if(!$request->ajax()) return redirect('/');              

        $tipoContribuyenteVehiculo = TipoContribuyenteVehiculo::findOrFail($id);   
        $tipoContribuyenteVehiculo->delete();
    }
}
