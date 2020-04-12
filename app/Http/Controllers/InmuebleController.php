<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inmueble;

class InmuebleController extends Controller
{
 	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $inmuebles = Inmueble::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $inmuebles = Inmueble::find($request->id);                
        }    
        return [ 
            'inmuebles' => $inmuebles
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
        $inmueble = new Inmueble();        
        
        $inmueble->idtipocontribuyenteinmueble = $request->tipo;
        $inmueble->denominacion = $request->denominacion;
        $inmueble->codigo_catastral = $request->codigo_catastral;
        $inmueble->numero_civico = $request->numero_civico;
        $inmueble->idzona = $request->idzona;
        $inmueble->tipo_vivienda = $request->tipo_vivienda;
        $inmueble->idregimen = $request->idregimen;
        $inmueble->numero_inscripcion = $request->numero_inscripcion;
        $inmueble->area_terreno = $request->area_terreno;
        $inmueble->area_construccion = $request->area_construccion;
        $inmueble->rif = $request->rif;
        $inmueble->telefono = $request->telefono;
        $inmueble->direccion = $request->direccion;
        $inmueble->save();        
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

        $inmueble = Inmueble::findOrFail($request->id);        
        $inmueble->idtipocontribuyenteinmueble = $request->tipo;
        $inmueble->denominacion = $request->denominacion;
        $inmueble->codigo_catastral = $request->codigo_catastral;
        $inmueble->numero_civico = $request->numero_civico;
        $inmueble->idzona = $request->idzona;
        $inmueble->tipo_vivienda = $request->tipo_vivienda;
        $inmueble->idregimen = $request->idregimen;
        $inmueble->numero_inscripcion = $request->numero_inscripcion;
        $inmueble->area_terreno = $request->area_terreno;
        $inmueble->area_construccion = $request->area_construccion;
        $inmueble->rif = $request->rif;
        $inmueble->telefono = $request->telefono;
        $inmueble->direccion = $request->direccion;
        $inmueble->save();    
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

        $inmueble = Inmueble::findOrFail($id);   
        $inmueble->delete();
    }
}
