<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comercio;
use App\Comerciotipo;
use App\TipoContribuyenteComercio;
use App\Bitacora;
use Auth;

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

        $datos = [
                'comercios' => $comercios,
            ];
        
        if($request->id) {
            $comercio = Comercio::find($request->id);    
            $tipos = Comerciotipo::where('idcomercio', '=', $request->id)->get();
            
            $datos = [
                'comercios' => $comercio,
                'tipos' => $tipos,
            ];
        } 

        return $datos;            
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
        $iduser = Auth::user()->id;
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

            $accion = 'Agrega Nuevo Contribuyente';
                Bitacora::create([
                    'accion' => $accion,
                    'iduser' => $iduser,            
                ]);    

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

        try{
            DB::beginTransaction();

        $comercio = Comercio::findOrFail($request->id);                
        $comercio->licencia = $request->licencia;
        $comercio->denominacion = $request->denominacion;
        $comercio->rif = $request->rif;
        $comercio->fecha_inscripcion = $request->fecha_inscripcion;
        $comercio->cedula = $request->cedula;
        $comercio->direccion = $request->direccion;
        $comercio->telefono = $request->telefono;      
        $comercio->save();

        $tipos_comercio = $request->tipos;//Array de Tipos de comercio

            foreach($tipos_comercio as $ep=>$tipo)
            {                
                $comercioTipo = Comerciotipo::where("idcomercio", "=", $request->id)->where("idtipo", '=', $tipo)->get();
                
                if(count($comercioTipo)==0) {
                    $comercioTipoAdd = new Comerciotipo();
                    $comercioTipoAdd->idtipo = $tipo;
                    $comercioTipoAdd->idcomercio = $comercio->id;
                    $comercioTipoAdd->save();
                }                
            }  

            $iduser = Auth::user()->id;
            $accion = 'Actualiza Contribuyente: '. $request->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'iduser' => $iduser,            
                ]);  

            DB::commit();

        } catch (Exception $e){

            DB::rollBack();
        }

        return $comercioTipo;
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
        $iduser = Auth::user()->id;
            $accion = 'Elimina Contribuyente: '. $comercio->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'iduser' => $iduser,            
                ]);  

           
        $comercio->delete();
    }
}
