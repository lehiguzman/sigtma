<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comercio;
use App\Comerciotipo;
use App\TipoContribuyenteComercio;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');        
        //$comercios = Comercio::orderBy('ID', 'DESC')->paginate();

        /*$comercios = Comercio::join('tipo_contribuyente_comercio', 'comercios.idtipocontribuyentecomercio', '=', 'tipo_contribuyente_comercio.id')            
            ->select('comercios.id', 'comercios.licencia', 'comercios.denominacion', 'comercios.rif', 'comercios.direccion', 'comercios.fecha_inscripcion', 'comercios.telefono', 'tipo_contribuyente_comercio.denominacion as tipo')
            ->orderBy('comercios.id', 'desc')->paginate(10); */
        $comercios = Comercio::orderBy('ID', 'DESC')->paginate();
        
        if($request->id) {
            $comercios = Comercio::find($request->id);            
        }    
        return [ 
            'comercios' => $comercios
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

        try{
            DB::beginTransaction();
            $comercio = new Comercio();     

        //Formateo la fecha 
        $date = new \DateTime($request->fecha_inscripcion);  
        
        $comercio->licencia = $request->licencia;
        $comercio->denominacion = $request->denominacion;
        $comercio->rif = $request->rif;
        $comercio->fecha_inscripcion = $date->format('Y-m-d');
        $comercio->cedula = $request->cedula;
        $comercio->direccion = $request->direccion;
        $comercio->telefono = $request->telefono;        
        $comercio->save();

        $tipos_comercio = $request->tipos;//Array de Tipos de comercio
            //Recorro todos los elementos       
 
            foreach($tipos_comercio as $ep=>$tipo)
            {
                $comercioTipo = new Comerciotipo();

                $comercioTipo->idtipo = $tipo;
                $comercioTipo->idcomercio = $comercio->id;
                
                $comercioTipo->save();
            }            

            DB::commit();

        } catch (Exception $e){

            DB::rollBack();
        }

    } 

    public function tipos(Request $request, $id) {

        $tipos_comercio = Comerciotipo::where("idcomercio", "=", $id)->get();

        foreach ($tipos_comercio as $key => $tipo) {
            $tipoComercio[] = TipoContribuyenteComercio::find($tipo->idtipo);                  
        }

        return $tipoComercio;
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

        $comercio = Comercio::findOrFail($request->id);        
        $comercio->idtipocontribuyentecomercio = $request->tipo;
        $comercio->licencia = $request->licencia;
        $comercio->denominacion = $request->denominacion;
        $comercio->rif = $request->rif;
        $comercio->fecha_inscripcion = $request->fecha_inscripcion;
        $comercio->cedula = $request->cedula;
        $comercio->direccion = $request->direccion;
        $comercio->telefono = $request->telefono;      
        $comercio->save();
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

        $comercio = Comercio::findOrFail($id);   
        $comercio->delete();
    }
}
