<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeclaracionInmueble;
use App\TipoContribuyenteInmueble;
use App\Periodo;
use App\Inmueble;
use App\Regimen;
use App\Zona;
use App\Bitacora;
use Auth;


class DeclaracionInmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        //$declaracionesInmueble = DeclaracionInmueble::orderBy('ID', 'DESC')->paginate();
        $declaracionesInmueble = DeclaracionInmueble::join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
                                ->selectRaw('inmuebles.id as idinmueble, inmuebles.codigo_catastral, inmuebles.denominacion, inmuebles.area_construccion, inmuebles.direccion, inmuebles.rif, inmuebles.area_terreno, declaracion_inmueble.idinmueble, sum(declaracion_inmueble.monto_impuesto) as monto_impuesto')->groupBy('inmuebles.id', 'inmuebles.denominacion', 'declaracion_inmueble.idinmueble', 'inmuebles.area_construccion', 'inmuebles.area_terreno', 'inmuebles.codigo_catastral', 'inmuebles.direccion', 'inmuebles.rif')
                                ->where("declaracion_inmueble.estado", "=", "calculado")->paginate();         
        return [ 
            'declaraciones_inmueble' => $declaracionesInmueble
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
        $periodos = $request->periodos;

        foreach($periodos as $ep=>$periodo)
        {

            $declaracionInmueble = new DeclaracionInmueble();

            $declaracionInmueble->idinmueble = $request->idinmueble;
            $declaracionInmueble->idperiodo = $periodo['id'];
            $declaracionInmueble->idzona = $request->idzona;    
            $declaracionInmueble->tipo_vivienda = $request->tipo_vivienda;
            $declaracionInmueble->idregimen = $request->idregimen;
            $declaracionInmueble->area_terreno = $request->area_terreno;
            $declaracionInmueble->area_construccion = $request->area_construccion;
            $declaracionInmueble->tipo_declaracion = 3;
            $declaracionInmueble->valor_total = $request->valor_total;
            $declaracionInmueble->monto_impuesto = $periodo['monto_impuesto'];
            $declaracionInmueble->estado = "calculado";
            $declaracionInmueble->save();
        }         

        $iduser = Auth::user()->id;
        $accion = 'Agrega Nueva Declaracion de Inmueble';
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $request->codigo_catastral,
                    'tipo_contribuyente' => 'inmueble',
                    'iduser' => $iduser,            
                ]);
    }

    public function selectDeclaracion(Request $request, $id) {

        //$date = new \DateTime('now');  

    	$inmueble = Inmueble::find($id);       
        $declaracionInmueble = declaracionInmueble::where("idinmueble", "=", $inmueble->id)->orderBy("idperiodo", 'DESC')->first();
        
        if($declaracionInmueble == NULL) {
            $ultimo_anio = "N/A";
            $periodo = Periodo::orderBy('ID', 'ASC')->where("periodo", '>', $inmueble->ultima_declaracion)->paginate();
        } else {
            $periodo = [];//Periodo::find($declaracionInmueble->idperiodo)->paginate();
            $ultimo_anio = "";//$periodo['periodo'];
        }
        
        $regimen = Regimen::find($inmueble->idregimen);
        $zona = Zona::find($inmueble->idzona);

        return $datos = [
            "ultimo" => $ultimo_anio,
            "inmueble" => $inmueble,
            "periodo" => $periodo,
            "regimen" => $regimen,
            "zona" => $zona
        ];
    }     

    public function selectDeclaracionInmueble(Request $request, $id) {

        $declaracion = DeclaracionInmueble::join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
                                ->selectRaw('inmuebles.id as idinmueble, 
                                            inmuebles.codigo_catastral, 
                                            inmuebles.denominacion, 
                                            inmuebles.area_construccion, 
                                            inmuebles.direccion, 
                                            inmuebles.rif, 
                                            inmuebles.area_terreno, 
                                            declaracion_inmueble.idinmueble,                                             
                                            sum(declaracion_inmueble.monto_impuesto) as monto_impuesto')
                                ->groupBy('inmuebles.id', 
                                          'inmuebles.denominacion', 
                                          'declaracion_inmueble.idinmueble', 
                                          'inmuebles.area_construccion', 
                                          'inmuebles.area_terreno', 
                                          'inmuebles.codigo_catastral', 
                                          'inmuebles.direccion', 
                                          'inmuebles.rif')
                                ->where('idinmueble', '=', $id)
                                ->where("declaracion_inmueble.estado", "=", "calculado")
                                ->first();
        return $datos = [
            'declaracion' => $declaracion,                       
        ];
    } 

    /**
     * Genera el estado de cuenta de inmueble
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edoCtaInmueble(Request $request)
    {        
        //if(!$request->ajax()) return redirect('/');

        $saldo = 0;
        $declaracionObj = [];
        $nombre = Auth::user()->name;     
        $montoPago = 0;   

        $inmueble = Inmueble::join('zonas', 'inmuebles.idzona', '=', 'zonas.id')->selectRaw('inmuebles.denominacion, inmuebles.direccion, inmuebles.codigo_catastral, inmuebles.numero_civico, inmuebles.idregimen, inmuebles.numero_inscripcion, inmuebles.area_terreno, inmuebles.area_construccion, zonas.nombre, inmuebles.telefono, inmuebles.rif')
        ->find($request->idinmueble);
        $inmuebleTipo = Regimen::find($inmueble->idregimen);

        $declaracionEstatus = DeclaracionInmueble::where("idinmueble", "=", $request->idinmueble)->get();

        foreach ($declaracionEstatus as $key => $declaracion) {
            if( $declaracion->estado == "calculado" ) {
                $declaracionInmueble = DeclaracionInmueble::join('periodos', 'declaracion_inmueble.idperiodo', '=', 'periodos.id')
                                    ->join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
                                    ->selectRaw('periodos.periodo, inmuebles.id as idinmueble, inmuebles.codigo_catastral, inmuebles.denominacion, inmuebles.area_construccion, inmuebles.direccion, inmuebles.rif, inmuebles.area_terreno, declaracion_inmueble.idinmueble, declaracion_inmueble.estado, declaracion_inmueble.monto_impuesto as monto_impuesto, declaracion_inmueble.created_at as fecha')
                                    ->where("declaracion_inmueble.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionInmueble->monto_impuesto;
                    $date = new \DateTime($declaracionInmueble->fecha); 

                $declaracionObj[] = [
                    "periodo" => $declaracionInmueble->periodo,
                    "estado" => $declaracion->estado,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionInmueble->monto_impuesto,
                    "fecha" => $date->format('d/m/Y'),
                ];
            } elseif($declaracion->estado == "pagado") {

                $declaracionInmueble = DeclaracionInmueble::join('periodos', 'declaracion_inmueble.idperiodo', '=', 'periodos.id')
                                    ->join('pagos', 'declaracion_inmueble.idpago', '=', 'pagos.id')
                                    ->join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
                                    ->selectRaw('periodos.periodo, inmuebles.id as idinmueble, inmuebles.codigo_catastral, inmuebles.denominacion, inmuebles.area_construccion, inmuebles.direccion, inmuebles.rif, inmuebles.area_terreno, declaracion_inmueble.idinmueble, declaracion_inmueble.estado, declaracion_inmueble.monto_impuesto as monto_impuesto, pagos.created_at as fecha, pagos.monto as monto_pago')
                                    ->where("declaracion_inmueble.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionInmueble->monto_impuesto;
                    $montoPago = $declaracionInmueble->monto_pago;
                    $date = new \DateTime($declaracionInmueble->fecha); 

                $declaracionObj[] = [
                    "periodo" => $declaracionInmueble->periodo,
                    "estado" => $declaracion->estado,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionInmueble->monto_impuesto,
                    "monto_pago" => $declaracionInmueble->monto_pago,
                    "fecha" => $date->format('d/m/Y'),
                ];
            }
        }
        
        $saldoFinal = $saldo - $montoPago;

            $view =  \View::make('pdf.edoCtaInmueble', compact('inmueble', 'declaracionObj', 'inmuebleTipo', 'nombre', 'saldoFinal'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('edoCuentaInmueble');
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

        $declaracionInmueble = DeclaracionInmueble::findOrFail($id);   
        $declaracionInmueble->delete();
    }
}
