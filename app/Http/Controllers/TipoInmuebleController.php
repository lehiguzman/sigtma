<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoContribuyenteInmueble;

class TipoInmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $tiposInmueble = TipoContribuyenteInmueble::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $tiposInmueble = TipoContribuyenteInmueble::find($request->id);                
        }    
        return [ 
            'tipos_inmueble' => $tiposInmueble
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
        $tipoContribuyenteInmueble = new TipoContribuyenteInmueble();        
        
        $tipoContribuyenteInmueble->numeral = $request->numeral;        
        $tipoContribuyenteInmueble->descripcion = $request->descripcion;
        $tipoContribuyenteInmueble->exonerado = $request->exonerado;        
        $tipoContribuyenteInmueble->save();        
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

        $tipoContribuyenteInmueble = TipoContribuyenteInmueble::findOrFail($request->id);        
        $tipoContribuyenteInmueble->numeral = $request->numeral;        
        $tipoContribuyenteInmueble->descripcion = $request->descripcion;
        $tipoContribuyenteInmueble->exonerado = $request->exonerado;        
        $tipoContribuyenteInmueble->save(); 
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

        $tipoContribuyenteInmueble = TipoContribuyenteInmueble::findOrFail($id);   
        $tipoContribuyenteInmueble->delete();
    }
}
