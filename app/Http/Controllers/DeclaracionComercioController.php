<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeclaracionComercio;
use App\Periodo;
use App\Comercio;
use App\Comerciotipo;
use App\TipoContribuyenteComercio;

class DeclaracionComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        /*$declaracionesComercio = DeclaracionComercio::join("comercios", "declaracion_comercio.idcomercio", "=", "comercios.id")
        ->selectRaw("comercios.denominacion, comercios.rif, comercios.direccion, declaracion_comercio.id, declaracion_comercio.tipo_declaracion, declaracion_comercio.monto_declaracion, declaracion_comercio.monto_impuesto")->where('declaracion_comercio.estado', '=', 'calculado')
        ->orderBy('declaracion_comercio.ID', 'DESC')
        ->get();*/
        $declaracionesComercio = DeclaracionComercio::join('periodos', 'declaracion_comercio.idperiodo', '=', 'periodos.id')
                                    ->join('comercios', 'declaracion_comercio.idcomercio', '=', 'comercios.id')
                                    ->selectRaw('periodos.periodo as periodo, 
                                                 comercios.id as id, 
                                                 comercios.rif, 
                                                 comercios.denominacion, 
                                                 comercios.direccion as direccion, 
                                                 comercios.licencia, 
                                                 declaracion_comercio.idcomercio as idcomercio, 
                                                 declaracion_comercio.estado, 
                                                 declaracion_comercio.tipo_declaracion as tipo_declaracion, 
                                                 sum(declaracion_comercio.monto_impuesto) as monto_impuesto')
                                    ->groupBy('periodos.periodo', 
                                              'comercios.id', 
                                              'comercios.rif', 
                                              'comercios.denominacion', 
                                              'comercios.direccion', 
                                              'comercios.licencia', 
                                              'declaracion_comercio.idcomercio', 
                                              'declaracion_comercio.estado', 
                                              'declaracion_comercio.tipo_declaracion')
                                    ->where('declaracion_comercio.estado', '=', 'calculado')
                                    ->get();
         
        return [ 
            'declaraciones_comercio' => $declaracionesComercio
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
        //$declaracionComercio = new DeclaracionComercio(); 

        $codigos = $request->codigos;
        $hayPagada = '0';

        $declaracionEstimada = DeclaracionComercio::where('idperiodo', '=', $request->idperiodo)->where('tipo_declaracion', '=', 1)->where('idcomercio', '=', $request->idcomercio)->where('estado', '=', 'calculado')->get();

        foreach ($declaracionEstimada as $key => $decEstimada) {
            $declaracionAct = DeclaracionComercio::find($decEstimada->id);                
            $declaracionAct->estado = "no_pagado";
            $declaracionAct->save();
        }

        $declaracionPagada = DeclaracionComercio::where('idperiodo', '=', $request->idperiodo)->where('tipo_declaracion', '=', 1)->where('idcomercio', '=', $request->idcomercio)->where('estado', '=', 'pagado')->get();       
            
        
        foreach($codigos as $ep=>$codigo)
            {
                $declaracionComercio = new DeclaracionComercio();                
                $montoImpuesto = $codigo['monto_impuesto'];

                if($declaracionPagada) {
                foreach ($declaracionPagada as $key => $montoPag) {
                        if($montoPag['idtipo'] == $codigo['id']) {
                            $montoImpuesto = $codigo['monto_impuesto'] - $montoPag['monto_impuesto'];
                        }
                    }
                } 

                $declaracionComercio->idcomercio = $request->idcomercio;
                $declaracionComercio->idperiodo = $request->idperiodo;
                $declaracionComercio->idtipo = $codigo['id'];
                $declaracionComercio->monto_declaracion = $codigo['monto'];
                $declaracionComercio->tipo_declaracion = $request->tipo_declaracion;
                $declaracionComercio->monto_impuesto = $montoImpuesto;
                $declaracionComercio->estado = "calculado";
                $declaracionComercio->save();
            }
         
    }

    public function selectDeclaracionComercio(Request $request, $id) {

        $date = new \DateTime('now');  

    	$declaracionComercio = DeclaracionComercio::where("idcomercio", '=', $id)->orderBy('ID', 'DESC')->first();	

    	if(!$declaracionComercio) {            
            $comercio = Comercio::find($id);
            $periodo = Periodo::where('periodo', '=',  $comercio->anio_inscripcion)->first();
    		$datos = [
    		'anio' => $comercio->anio_inscripcion,
    		'tipoDeclaracion' => 1,
            'periodo' => $periodo,
            'estado_declaracion' => 'estimada_inicial'
    		];
    		return $datos;
    	} else {

            $periodo = Periodo::find($declaracionComercio->idperiodo);
            $anioActual = $date->format('Y');
            $ultimoPeriodoDeclarado = $periodo->periodo;
            $tipoDeclaracion = $declaracionComercio->tipo_declaracion;

            if($declaracionComercio->estado == "calculado" && $declaracionComercio->tipo_declaracion == "2") {
               $datos = [
                'anio' => $periodo->periodo,
                'tipoDeclaracion' => 2,
                'periodo' => $periodo,
                'estado_declaracion' => 'deuda',
                ];
            } else {

                if( $tipoDeclaracion == 1 ) {                
                    $datos = [
                    'anio' => $ultimoPeriodoDeclarado,
                    'tipoDeclaracion' => 2,
                    'periodo' => $periodo,
                    'estado_declaracion' => 'definitiva'
                    ];
                } else {
                    if($anioActual == $ultimoPeriodoDeclarado) {
                        return false;
                    } else {

                        $declaracionAnioAnterior = DeclaracionComercio::selectRaw('idtipo, sum(monto_declaracion) as monto_declaracion')->groupBy('idtipo')->where("idperiodo", '=', $declaracionComercio->idperiodo)->get();

                        $periodoNuevo = $ultimoPeriodoDeclarado + 1;
                        $datos = [
                            'anio' => $periodoNuevo,
                            'tipoDeclaracion' => 1,
                            'periodo' => $periodo,
                            'estado_declaracion' => 'estimada',
                            'ultimaDeclaracion' => $declaracionAnioAnterior
                        ];
                    }
                }
    	   }    	
        }
    	return $datos;
    }

    public function selectDeclaracion(Request $request, $id) {

        //$declaracion = DeclaracionComercio::where("idcomercio", "=", $id);
        //$comercio = Comercio::find($id);

        $declaracion = DeclaracionComercio::join('periodos', 'declaracion_comercio.idperiodo', '=', 'periodos.id')
                                    ->join('comercios', 'declaracion_comercio.idcomercio', '=', 'comercios.id')
                                    ->selectRaw('periodos.periodo as periodo, 
                                                 comercios.id as id, 
                                                 comercios.rif, 
                                                 comercios.denominacion, 
                                                 comercios.direccion as direccion, 
                                                 comercios.licencia, 
                                                 declaracion_comercio.idcomercio as idcomercio, 
                                                 declaracion_comercio.estado, 
                                                 declaracion_comercio.tipo_declaracion as tipo_declaracion, 
                                                 sum(declaracion_comercio.monto_declaracion) as monto_declaracion,
                                                 sum(declaracion_comercio.monto_impuesto) as monto_impuesto')
                                    ->groupBy('periodos.periodo', 
                                              'comercios.id', 
                                              'comercios.rif', 
                                              'comercios.denominacion', 
                                              'comercios.direccion', 
                                              'comercios.licencia', 
                                              'declaracion_comercio.idcomercio', 
                                              'declaracion_comercio.estado', 
                                              'declaracion_comercio.tipo_declaracion')
                                    ->where('declaracion_comercio.estado', '=', 'calculado')
                                    ->where('declaracion_comercio.idcomercio', '=', $id )
                                    ->first();

        //$periodo = Periodo::find($declaracion->idperiodo);

        return $datos = [
            'declaracion' => $declaracion,                       
        ];
    }

    /**
     * Genera el estado de cuenta de comercio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edoCtaComercio(Request $request)
    {        
        //if(!$request->ajax()) return redirect('/');

        $saldo = 0;
        $declaracionObj = [];
        
        $comercio = Comercio::find($request->idcomercio);
        $tipos = Comerciotipo::where("idcomercio", "=", $request->idcomercio)->get();

        foreach ($tipos as $key => $tipo) {
                    $ramas[] = tipoContribuyenteComercio::find($tipo->idtipo);
                }        

        $declaracionEstatus = DeclaracionComercio::where("idcomercio", "=", $request->idcomercio)->get();

        foreach ($declaracionEstatus as $key => $declaracion) {
            if( $declaracion->estado == "calculado" || $declaracion->estado == "no_pagado") {
                $declaracionComercio = DeclaracionComercio::join('periodos', 'declaracion_comercio.idperiodo', '=', 'periodos.id')
                                    ->join('comercios', 'declaracion_comercio.idcomercio', '=', 'comercios.id')
                                    ->selectRaw('periodos.periodo as periodo, comercios.id as idcomercio, comercios.rif, comercios.denominacion, comercios.direccion, comercios.licencia, declaracion_comercio.idcomercio, declaracion_comercio.estado, declaracion_comercio.tipo_declaracion, declaracion_comercio.monto_impuesto as monto_impuesto')
                                    ->where("declaracion_comercio.id", "=", $declaracion->id)
                                    ->first();

                    $saldo = $saldo + $declaracionComercio->monto_impuesto;

                    //$declaracionObj = $declaracionComercio;

                $declaracionObj[] = [
                    "periodo" => $declaracionComercio->periodo,
                    "estado" => $declaracion->estado,
                    "tipo_declaracion" => $declaracion->tipo_declaracion,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionComercio->monto_impuesto
                ];
            } elseif($declaracion->estado == "pagado") {

                $declaracionComercio = DeclaracionComercio::join('periodos', 'declaracion_comercio.idperiodo', '=', 'periodos.id')
                                    ->join('pagos', 'declaracion_comercio.idpago', '=', 'pagos.id')
                                    ->join('comercios', 'declaracion_comercio.idcomercio', '=', 'comercios.id')
                                    ->selectRaw('periodos.periodo, comercios.id as idcomercio, comercios.rif, comercios.denominacion, comercios.direccion, comercios.licencia, declaracion_comercio.estado, declaracion_comercio.tipo_declaracion, pagos.monto as monto_impuesto')
                                    ->where("declaracion_comercio.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionComercio->monto_impuesto;

                $declaracionObj[] = [
                    "periodo" => $declaracionComercio->periodo,
                    "estado" => $declaracion->estado,
                    "tipo_declaracion" => $declaracion->tipo_declaracion,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionComercio->monto_impuesto
                ];
            }
        }

             $pdf = \PDF::loadView('pdf.edoCtaComercio', ['comercio' => $comercio , 'declaracionObj' => $declaracionObj, 'ramas' => $ramas ]);
                    return $pdf->download('EstadoCta Comercio.pdf');
        
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

        $declaracionComercio = DeclaracionComercio::findOrFail($id);   
        $declaracionComercio->delete();
    }
}
