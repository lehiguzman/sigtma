<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inmueble;
use App\Bitacora;
use App\DeclaracionInmueble;
use Auth;
use App\User;

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
        $inmuebleArray = [];
        
        $inmueblesAll = Inmueble::orderBy('ID', 'DESC')->paginate();
        $iduser = $iduser = Auth::user()->id;
        $rol = User::find($iduser)->roles()->first();


        foreach ($inmueblesAll as $key => $inmueble) {
            $declaraciones = DeclaracionInmueble::where('idinmueble', '=', $inmueble->id)->count();
            $calculados = DeclaracionInmueble::where('idinmueble', '=', $inmueble->id)->where("estado", '=', 'calculado')->count();
            $pagos = DeclaracionInmueble::where('idinmueble', '=', $inmueble->id)->where("estado", '=', 'pagado')->count();
            $inmuebleDec = [
                'id' => $inmueble->id,
                'codigo_catastral' => $inmueble->codigo_catastral,
                'denominacion' => $inmueble->denominacion,
                'area_terreno' => $inmueble->area_terreno,
                'area_construccion' => $inmueble->area_construccion,
                'numero_inscripcion' => $inmueble->numero_inscripcion,
                'telefono' => $inmueble->telefono,
                'rif' => $inmueble->rif,
                'fecha_inscripcion' => $inmueble->fecha_inscripcion,
                'direccion' => $inmueble->direccion,
                'declaraciones' => $declaraciones,
                'calculados' => $calculados,
                'pagos' => $pagos
            ];

            $inmuebleArray[] = $inmuebleDec;
        } 

        $inmuebles = $inmuebleArray;

        if($request->id) {
            $inmuebles = Inmueble::find($request->id);                
        }    

        return [ 
            'inmuebles' => $inmuebles,
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
        $inmueble = new Inmueble();                
        
        $inmueble->idregimen = $request->idregimen;
        $inmueble->denominacion = $request->denominacion;
        $inmueble->codigo_catastral = $request->codigo_catastral;
        $inmueble->numero_civico = $request->numero_civico;
        $inmueble->idzona = $request->idzona;
        $inmueble->tipo_vivienda = $request->tipo_vivienda;
        $inmueble->ultima_declaracion = $request->ultima_declaracion;
        $inmueble->numero_inscripcion = $request->numero_inscripcion;
        $inmueble->area_terreno = $request->area_terreno;
        $inmueble->area_construccion = $request->area_construccion;
        $inmueble->rif = $request->rif;
        $inmueble->telefono = $request->telefono;
        $inmueble->direccion = $request->direccion;
        $inmueble->save();   

        $iduser = Auth::user()->id;
        $accion = 'Agrega Nuevo Contribuyente';
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $inmueble->codigo_catastral,
                    'tipo_contribuyente' => 'inmueble',
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

        $iduser = Auth::user()->id;
            $accion = 'Actualiza Contribuyente: '. $request->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $inmueble->codigo_catastral,
                    'tipo_contribuyente' => 'inmueble',
                    'iduser' => $iduser,            
                ]);   
    }

    public function historico(Request $request, $id) {

        $inmueble = Inmueble::find($id);
        $pagos = DeclaracionInmueble::join("pagos", "declaracion_inmueble.idpago", "=", "pagos.id")
                                    ->join("detalle_pagos", "pagos.id", "=", "detalle_pagos.idpago")
                                    ->selectRaw('distinct(declaracion_inmueble.idpago), detalle_pagos.referencia, detalle_pagos.fecha_pago, detalle_pagos.banco, detalle_pagos.monto, detalle_pagos.tipo_pago')
                                    ->where('declaracion_inmueble.idinmueble', '=', $id)
                                    ->get();

        return $datos = [ 
            'inmueble' => $inmueble,
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

        $inmueble = Inmueble::findOrFail($id);   

        $accion = 'Elimina Contribuyente: '. $inmueble->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $inmueble->codigo_catastral,
                    'tipo_contribuyente' => 'inmueble',
                    'iduser' => $iduser,            
                ]);  
        $inmueble->delete();
    }
}
