<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeclaracionComercio;
use App\Periodo;
use App\Comercio;
use App\Comerciotipo;
use App\TipoContribuyenteComercio;
use App\Bitacora;
use App\Pago;
use Auth;

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
        $iduser = Auth::user()->id;
        $hayPagada = '0';

        $declaracionEstimada = DeclaracionComercio::where('idperiodo', '=', $request->idperiodo)
                    ->where('idcomercio', '=', $request->idcomercio)
                    ->where('estado', '=', 'calculado')
                    ->get();

        foreach ($declaracionEstimada as $key => $decEstimada) {
            $declaracionAct = DeclaracionComercio::find($decEstimada->id);                
            $declaracionAct->estado = "calculado";
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

            $accion = 'Agrega Nueva Declaracion de Comercio';
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $request->licencia,
                    'tipo_contribuyente' => 'comercio',
                    'iduser' => $iduser,            
                ]);
         
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

            if($periodo->periodo == $anioActual && $declaracionComercio->tipo_declaracion == "1") {
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
                        $periodoSig = Periodo::where("periodo", '=', $periodoNuevo)->first();
                        $datos = [
                            'anio' => $periodoNuevo,
                            'tipoDeclaracion' => 1,
                            'periodo' => $periodoSig,
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
                                    ->selectRaw('comercios.id as id, 
                                                 comercios.rif, 
                                                 comercios.denominacion, 
                                                 comercios.direccion as direccion, 
                                                 comercios.licencia, 
                                                 declaracion_comercio.idcomercio as idcomercio, 
                                                 sum(declaracion_comercio.monto_declaracion) as monto_declaracion,
                                                 sum(declaracion_comercio.monto_impuesto) as monto_impuesto')
                                    ->groupBy('comercios.id', 
                                              'comercios.rif', 
                                              'comercios.denominacion', 
                                              'comercios.direccion', 
                                              'comercios.licencia', 
                                              'declaracion_comercio.idcomercio')
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
        
        $comercio = Comercio::find($request->idcomercio);  
        $saldo = 0;  
        $saldoFinal = 0;
        $montoPago = 0;    
        $estado = "";
        $pago = [];  
        $ramas = Comerciotipo::join("tipo_contribuyente_comercio", "comercios_tipo.idtipo", "=", "tipo_contribuyente_comercio.id")
        ->where("idcomercio", "=", $request->idcomercio)
        ->get();

        $anios_declarados = DeclaracionComercio::where('idcomercio', '=', $request->idcomercio)
        ->groupBy('idperiodo', 'tipo_declaracion', 'estado')
        ->selectRaw('idperiodo, tipo_declaracion, estado')
        ->get();
        
        foreach ($anios_declarados as $key => $anios) {            
                $declaracion = DeclaracionComercio::where('idcomercio', '=', $request->idcomercio)
                                                  ->where("idperiodo", "=", $anios->idperiodo)
                                                  ->where("tipo_declaracion", "=", $anios->tipo_declaracion)
                                                  ->groupBy('idperiodo', 'tipo_declaracion', 'created_at', 'idpago')
                                                  ->selectRaw('tipo_declaracion ,sum(monto_impuesto) as monto_impuesto, created_at as fecha, idpago')
                                                  ->first(); 
                                                  //print($declaracion->monto); exit();              

                $periodo = Periodo::find($anios->idperiodo);

                //print($periodo);

                if($anios->estado == "pagado") {
                    $pago = Pago::find($declaracion->idpago);
                    $montoPago = $pago->monto;
                    $estado = "pagado";
                }

                $saldo = $saldo + $declaracion->monto_impuesto;

                $declaracionObj[] = [
                    'fecha' => $declaracion->fecha,
                    'periodo' => $periodo->periodo,
                    'tipo_declaracion' => $declaracion->tipo_declaracion,
                    'monto_impuesto' => $declaracion->monto_impuesto,
                    'saldo' => $saldo,                    
                ];
        }        

        $nombre = Auth::user()->name;  
        $saldoFinal = $saldo - $montoPago;

        //print( $montoPago ); exit();

        $view =  \View::make('pdf.edoCtaComercio', compact('comercio', 'ramas', 'nombre', 'declaracionObj', 'pago', 'saldoFinal', 'estado'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('edoCtacomercio'); 
        
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
