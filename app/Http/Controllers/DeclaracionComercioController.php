<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeclaracionComercio;
use App\Periodo;

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
        
        $declaracionesComercio = DeclaracionComercio::orderBy('ID', 'DESC')->paginate();
         
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

        foreach($codigos as $ep=>$codigo)
            {
                $declaracionComercio = new DeclaracionComercio();

                $declaracionComercio->idcomercio = $request->idcomercio;
                $declaracionComercio->idperiodo = $request->idperiodo;
                $declaracionComercio->idtipo = $codigo['id'];
                $declaracionComercio->monto_declaracion = $codigo['monto'];
                $declaracionComercio->tipo_declaracion = $request->tipo_declaracion;
                $declaracionComercio->monto_impuesto = $codigo['monto_impuesto'];
                $declaracionComercio->save();
            }
         
    }

    public function selectDeclaracion(Request $request, $id) {

        $date = new \DateTime('now');  

    	$declaracionComercio = DeclaracionComercio::where("idcomercio", '=', $id)->orderBy('ID', 'DESC')->first();	

    	if(!$declaracionComercio) {
            $periodo = Periodo::orderBy('ID', 'ASC')->first();
    		$datos = [
    		'anio' => "2018",
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

    	return $datos;
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
