<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\DeclaracionVehiculo;
use App\Bitacora;
use Auth;
use App\User;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        $vehiculoArray = [];
        
        $vehiculosAll = Vehiculo::orderBy('ID', 'DESC')->paginate();

        $iduser = $iduser = Auth::user()->id;
        $rol = User::find($iduser)->roles()->first();

        foreach ($vehiculosAll as $key => $vehiculo) {
            $declaraciones = DeclaracionVehiculo::where('idvehiculo', '=', $vehiculo->id)->count();
            $calculados = DeclaracionVehiculo::where('idvehiculo', '=', $vehiculo->id)->where("estado", '=', 'calculado')->count();
            $pagos = DeclaracionVehiculo::where('idvehiculo', '=', $vehiculo->id)->where("estado", '=', 'pagado')->count();
            $vehiculoDec = [
                'id' => $vehiculo->id,
                'placa' => $vehiculo->placa,
                'denominacion' => $vehiculo->denominacion,
                'serial' => $vehiculo->serial,
                'rif' => $vehiculo->rif,  
                'telefono' => $vehiculo->telefono,                
                'direccion' => $vehiculo->direccion,
                'declaraciones' => $declaraciones,
                'calculados' => $calculados,
                'pagos' => $pagos
            ];

            $vehiculoArray[] = $vehiculoDec;
        } 

        $vehiculos = $vehiculoArray;

        if($request->id) {
            $vehiculos = Vehiculo::find($request->id);                
        }    
        return [ 
            'vehiculos' => $vehiculos,
            'rol' => $rol
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
        $vehiculo = new Vehiculo();        
        
        $vehiculo->idtipocontribuyentevehiculo = $request->tipo;
        $vehiculo->denominacion = $request->denominacion;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->placa = $request->placa;
        $vehiculo->serial = $request->serial;             
        $vehiculo->rif = $request->rif;
        $vehiculo->anio = $request->anio;
        $vehiculo->telefono = $request->telefono;
        $vehiculo->direccion = $request->direccion;
        $vehiculo->save();

        $iduser = Auth::user()->id;
        $accion = 'Agrega Contribuyente';
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $vehiculo->placa,
                    'tipo_contribuyente' => 'vehiculo',
                    'iduser' => $iduser,            
                ]);   
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

        $vehiculo = Vehiculo::findOrFail($request->id);        
        $vehiculo->idtipocontribuyentevehiculo = $request->tipo;
        $vehiculo->denominacion = $request->denominacion;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->placa = $request->placa;
        $vehiculo->serial = $request->serial;
        $vehiculo->anio = $request->anio;     
        $vehiculo->rif = $request->rif;
        $vehiculo->telefono = $request->telefono;
        $vehiculo->direccion = $request->direccion;
        $vehiculo->save(); 

        $iduser = Auth::user()->id;
            $accion = 'Actualiza Contribuyente: '. $request->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $vehiculo->placa,
                    'tipo_contribuyente' => 'vehiculo',
                    'iduser' => $iduser,            
                ]);   
    }

    public function historico(Request $request, $id) {

        $vehiculo = Vehiculo::find($id);
        $pagos = DeclaracionVehiculo::join("pagos", "declaracion_vehiculo.idpago", "=", "pagos.id")
                                    ->join("detalle_pagos", "pagos.id", "=", "detalle_pagos.idpago")
                                    ->selectRaw('distinct(declaracion_vehiculo.idpago), detalle_pagos.referencia, detalle_pagos.fecha_pago, detalle_pagos.banco, detalle_pagos.monto, detalle_pagos.tipo_pago')
                                    ->where('declaracion_vehiculo.idvehiculo', '=', $id)
                                    ->get();

        return $datos = [ 
            'vehiculo' => $vehiculo,
            'pagos' => $pagos
        ];
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

        $vehiculo = Vehiculo::findOrFail($id); 
        $iduser = Auth::user()->id;

        $accion = 'Elimina Contribuyente: '. $vehiculo->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $vehiculo->placa,
                    'tipo_contribuyente' => 'vehiculo',
                    'iduser' => $iduser,            
                ]);  
        $vehiculo->delete();
    }
}
