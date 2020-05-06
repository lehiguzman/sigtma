<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoContribuyenteComercio;

class TipoComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $tiposComercio = TipoContribuyenteComercio::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $tiposComercio = TipoContribuyenteComercio::find($request->id);                
        }    
        return [ 
            'tipos_comercio' => $tiposComercio
        ];
    }

     public function listarTipoComercio(Request $request) {

        if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;

        if($buscar==''){

            $tipoComercio = TipoContribuyenteComercio::orderBy('ID', 'DESC')->paginate();

        } else {

            $tipoComercio = TipoContribuyenteComercio::where('tipo_contribuyente_comercio.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('tipo_contribuyente_comercio.id', 'desc')->paginate(10);
        }
         
        return[ 'tipoComercio' =>$tipoComercio ];    
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
        $tipoContribuyenteComercio = new TipoContribuyenteComercio();        
        
        $tipoContribuyenteComercio->denominacion = $request->denominacion;
        $tipoContribuyenteComercio->codigo = $request->codigo;
        $tipoContribuyenteComercio->descripcion = $request->descripcion;
        $tipoContribuyenteComercio->alicuota_anual = $request->alicuota_anual;
        $tipoContribuyenteComercio->minimo_tributable = $request->minimo_tributable;        
        $tipoContribuyenteComercio->save();        
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

        $tipoContribuyenteComercio = TipoContribuyenteComercio::findOrFail($request->id);        
        $tipoContribuyenteComercio->denominacion = $request->denominacion;        
        $tipoContribuyenteComercio->codigo = $request->codigo;
        $tipoContribuyenteComercio->descripcion = $request->descripcion;
        $tipoContribuyenteComercio->alicuota_anual = $request->alicuota_anual;      
        $tipoContribuyenteComercio->minimo_tributable = $request->minimo_tributable;      
        $tipoContribuyenteComercio->save();
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

        $tipoContribuyenteComercio = TipoContribuyenteComercio::findOrFail($id);   
        $tipoContribuyenteComercio->delete();
    }
}
