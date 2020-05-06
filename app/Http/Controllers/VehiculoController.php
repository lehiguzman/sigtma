<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Bitacora;
use Auth;

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
        
        $vehiculos = Vehiculo::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $vehiculos = Vehiculo::find($request->id);                
        }    
        return [ 
            'vehiculos' => $vehiculos
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
        $vehiculo->telefono = $request->telefono;
        $vehiculo->direccion = $request->direccion;
        $vehiculo->save();

        $iduser = Auth::user()->id;
        $accion = 'Agrega Nuevo Contribuyente';
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
