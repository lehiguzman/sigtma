<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comercio;
use App\Comerciotipo;
use App\TipoContribuyenteComercio;
use App\Bitacora;
use App\DeclaracionComercio;
use Auth;
use App\Pago;
use App\User;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comercioArray = [];
        $comercios = Comercio::orderBy('ID', 'DESC')->paginate();

        $iduser = $iduser = Auth::user()->id;
        $rol = User::find($iduser)->roles()->first();

        foreach ($comercios as $key => $comercio) {
            $declaraciones = DeclaracionComercio::where('idcomercio', '=', $comercio->id)->count();
            $calculados = DeclaracionComercio::where('idcomercio', '=', $comercio->id)->where("estado", '=', 'calculado')->count();
            $pagos = DeclaracionComercio::where('idcomercio', '=', $comercio->id)->where("estado", '=', 'pagado')->count();
            $comercioDec = [
                'id' => $comercio->id,
                'licencia' => $comercio->licencia,
                'denominacion' => $comercio->denominacion,
                'rif' => $comercio->rif,
                'fecha_inscripcion' => $comercio->fecha_inscripcion,
                'direccion' => $comercio->direccion,
                'declaraciones' => $declaraciones,
                'calculados' => $calculados,
                'pagos' => $pagos                
            ];

            $comercioArray[] = $comercioDec;
        }        

        $datos = [
                'comercios' => $comercioArray,
                'rol' => $rol              
            ];

        
        if($request->id) {
            $comercio = Comercio::find($request->id);    
            $tipos = Comerciotipo::join('tipo_contribuyente_comercio', 'comercios_tipo.idtipo', '=', 'tipo_contribuyente_comercio.id')
            ->where('comercios_tipo.idcomercio', '=', $request->id)->get();            
            
            $datos = [
                'comercios' => $comercio,
                'tipos' => $tipos,
                'rol' => $rol
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
        $comercio->anio_inscripcion = $date->format('Y');
        $comercio->cedula = $request->cedula;
        $comercio->direccion = $request->direccion;
        $comercio->telefono = $request->telefono;        
        $comercio->save();

        $tipos_comercio = $request->tipos;//Array de Tipos de comercio
            //Recorro todos los elementos       
 
            foreach($tipos_comercio as $ep=>$tipo)
            {
                $comercioTipo = new Comerciotipo();

                $comercioTipo->idtipo = $tipo['idtipo'];
                $comercioTipo->idcomercio = $comercio->id;
                
                $comercioTipo->save();
            }

            $accion = 'Agrega Nuevo Contribuyente';
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $request->licencia,
                    'tipo_contribuyente' => 'comercio',
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

            $date = new \DateTime($request->fecha_inscripcion);  

        $comercio = Comercio::findOrFail($request->id);                
        $comercio->licencia = $request->licencia;
        $comercio->denominacion = $request->denominacion;
        $comercio->rif = $request->rif;
        $comercio->fecha_inscripcion = $date->format('Y-m-d');
        $comercio->anio_inscripcion = $date->format('Y');
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
                    $comercioTipoAdd->idtipo = $tipo['idtipo'];
                    $comercioTipoAdd->idcomercio = $comercio->id;
                    $comercioTipoAdd->save();
                }                
            }  

            $iduser = Auth::user()->id;
            $accion = 'Actualiza Contribuyente: '. $request->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $request->licencia,
                    'tipo_contribuyente' => 'comercio',
                    'iduser' => $iduser,            
                ]);  

            DB::commit();

        } catch (Exception $e){

            DB::rollBack();
        }

        return $comercio;
    }

    public function historico(Request $request, $id) {

        $comercio = Comercio::find($id);
        $pagos = DeclaracionComercio::join("pagos", "declaracion_comercio.idpago", "=", "pagos.id")
                                    ->join("detalle_pagos", "pagos.id", "=", "detalle_pagos.idpago")
                                    ->selectRaw('distinct(declaracion_comercio.idpago), detalle_pagos.referencia, detalle_pagos.fecha_pago, detalle_pagos.banco, detalle_pagos.monto, detalle_pagos.tipo_pago')
                                    ->where('declaracion_comercio.idcomercio', '=', $id)
                                    ->get();

        return $datos = [ 
            'comercio' => $comercio,
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
        $comercio = Comercio::findOrFail($id);
        $iduser = Auth::user()->id;
            $accion = 'Elimina Contribuyente: '. $comercio->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $comercio->rif,
                    'tipo_contribuyente' => 'comercio',
                    'iduser' => $iduser,            
                ]);           
        $comercio->delete();
    }
}
