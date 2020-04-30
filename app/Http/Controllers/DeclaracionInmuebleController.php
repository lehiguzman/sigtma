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
                    'iduser' => $iduser,            
                ]);
    }

    public function selectDeclaracion(Request $request, $id) {

        //$date = new \DateTime('now');  

    	$inmueble = Inmueble::find($id);       
        $declaracionInmueble = declaracionInmueble::where("idinmueble", "=", $inmueble->id)->orderBy("idperiodo", 'DESC')->first();
        
        if($declaracionInmueble == NULL) {
            $ultimo_anio = "N/A";
            $periodo = Periodo::orderBy('ID', 'ASC')->paginate();
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
                                ->selectRaw('inmuebles.id as idinmueble, inmuebles.codigo_catastral, inmuebles.denominacion, inmuebles.area_construccion, inmuebles.direccion, inmuebles.rif, inmuebles.area_terreno, declaracion_inmueble.idinmueble, sum(declaracion_inmueble.monto_impuesto) as monto_impuesto')->groupBy('inmuebles.id', 'inmuebles.denominacion', 'declaracion_inmueble.idinmueble', 'inmuebles.area_construccion', 'inmuebles.area_terreno', 'inmuebles.codigo_catastral', 'inmuebles.direccion', 'inmuebles.rif')->where('idinmueble', '=', $id)->where("declaracion_inmueble.estado", "=", "calculado")->first();
        return $declaracion;
    } 

    /**
     * Genera el estado de cuenta de comercio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edoCtaInmueble(Request $request)
    {        
        //if(!$request->ajax()) return redirect('/');

        $saldo = 0;
        $declaracionObj = [];

        $inmueble = Inmueble::join('zonas', 'inmuebles.idzona', '=', 'zonas.id')->selectRaw('inmuebles.denominacion, inmuebles.direccion, inmuebles.codigo_catastral, inmuebles.numero_civico, inmuebles.numero_inscripcion, inmuebles.area_terreno, inmuebles.area_construccion, zonas.nombre, inmuebles.telefono, inmuebles.rif')
        ->find($request->idinmueble);
        $inmuebleTipo = TipoContribuyenteInmueble::find($request->idinmueble);

        $declaracionEstatus = DeclaracionInmueble::where("idinmueble", "=", $request->idinmueble)->get();

        foreach ($declaracionEstatus as $key => $declaracion) {
            if( $declaracion->estado == "calculado" ) {
                $declaracionInmueble = DeclaracionInmueble::join('periodos', 'declaracion_inmueble.idperiodo', '=', 'periodos.id')
                                    ->join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
                                    ->selectRaw('periodos.periodo, inmuebles.id as idinmueble, inmuebles.codigo_catastral, inmuebles.denominacion, inmuebles.area_construccion, inmuebles.direccion, inmuebles.rif, inmuebles.area_terreno, declaracion_inmueble.idinmueble, declaracion_inmueble.estado, declaracion_inmueble.monto_impuesto as monto_impuesto')
                                    ->where("declaracion_inmueble.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionInmueble->monto_impuesto;

                $declaracionObj[] = [
                    "periodo" => $declaracionInmueble->periodo,
                    "estado" => $declaracion->estado,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionInmueble->monto_impuesto
                ];
            } elseif($declaracion->estado == "pagado") {

                $declaracionInmueble = DeclaracionInmueble::join('periodos', 'declaracion_inmueble.idperiodo', '=', 'periodos.id')
                                    ->join('pagos', 'declaracion_inmueble.idpago', '=', 'pagos.id')
                                    ->join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
                                    ->selectRaw('periodos.periodo, inmuebles.id as idinmueble, inmuebles.codigo_catastral, inmuebles.denominacion, inmuebles.area_construccion, inmuebles.direccion, inmuebles.rif, inmuebles.area_terreno, declaracion_inmueble.idinmueble, declaracion_inmueble.estado, pagos.monto as monto_impuesto, pagos.referencia, pagos.banco')
                                    ->where("declaracion_inmueble.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionInmueble->monto_impuesto;

                $declaracionObj[] = [
                    "periodo" => $declaracionInmueble->periodo,
                    "estado" => $declaracion->estado,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionInmueble->monto_impuesto
                ];
            }
        }
        

        $pdf = \PDF::loadView('pdf.edoCtaInmueble', ['inmueble' => $inmueble , 'declaracionObj' => $declaracionObj, 'inmuebleTipo' => $inmuebleTipo ]);
            return $pdf->download('EstadoCta Inmueble.pdf');
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
