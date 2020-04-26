<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Periodo;
use App\DeclaracionVehiculo;
use App\TipoContribuyenteVehiculo;
use App\Bitacora;
use Auth;


class DeclaracionVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        //$declaracionesVehiculo = DeclaracionVehiculo::orderBy('ID', 'DESC')->paginate();
        $declaracionesVehiculo = DeclaracionVehiculo::join('vehiculos', 'declaracion_vehiculo.idvehiculo', '=', 'vehiculos.id')
                                ->selectRaw('vehiculos.id as idvehiculo, vehiculos.denominacion, vehiculos.direccion, vehiculos.placa, vehiculos.rif, declaracion_vehiculo.idvehiculo, sum(declaracion_vehiculo.monto_impuesto) as monto_impuesto')->groupBy('vehiculos.id', 'vehiculos.denominacion', 'declaracion_vehiculo.idvehiculo', 'vehiculos.placa', 'vehiculos.direccion', 'vehiculos.rif')->where("declaracion_vehiculo.estado", "=", "calculado")->paginate();
         
        return [ 
            'declaraciones_vehiculo' => $declaracionesVehiculo
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

        $declaracionVehiculo = new DeclaracionVehiculo();

        foreach($periodos as $ep=>$periodo)
            { 
                $monto_impuesto = $request->monto_ut * $periodo['unidad_tributaria'];

                $declaracionVehiculo->idvehiculo = $request->idvehiculo;
                $declaracionVehiculo->idperiodo = $periodo['id'];      
                $declaracionVehiculo->tipo_declaracion = 4;      
                $declaracionVehiculo->monto_impuesto = $monto_impuesto;
                $declaracionVehiculo->estado = "calculado";                
                $declaracionVehiculo->save();   
            }   

        $iduser = Auth::user()->id;
        $accion = 'Agrega Nueva Declaracion de Vehiculo';
                Bitacora::create([
                    'accion' => $accion,
                    'iduser' => $iduser,            
                ]);           
    }

    public function selectDeclaracion(Request $request, $id) {

        //$date = new \DateTime('now');          
        $periodos = [];

    	$vehiculo = Vehiculo::find($id);
        $tipo_vehiculo = TipoContribuyenteVehiculo::find($vehiculo->idtipocontribuyentevehiculo);
        $declaracionVehiculo = DeclaracionVehiculo::where("idvehiculo", "=", $vehiculo->id)->orderBy("idperiodo", 'DESC')->first();
        $periodos = Periodo::orderBy("ID", "ASC")->get();
       
        return $datos = [            
            "vehiculo" => $vehiculo,
            "tipo_vehiculo" => $tipo_vehiculo,
            "periodos" => $periodos 
        ];
    }

    public function selectDeclaracionVehiculo(Request $request, $id) {

        $declaracion = DeclaracionVehiculo::join('vehiculos', 'declaracion_vehiculo.idvehiculo', '=', 'vehiculos.id')
                                ->selectRaw('vehiculos.id as idvehiculo, vehiculos.direccion, vehiculos.placa, vehiculos.denominacion, vehiculos.direccion, vehiculos.rif, declaracion_vehiculo.idvehiculo, sum(declaracion_vehiculo.monto_impuesto) as monto_impuesto')->groupBy('vehiculos.id', 'vehiculos.denominacion', 'vehiculos.direccion', 'declaracion_vehiculo.idvehiculo', 'vehiculos.placa', 'vehiculos.rif')->where('idvehiculo', '=', $id)->where("declaracion_vehiculo.estado", "=", "calculado")->first();
        return $declaracion;
    }

    /**
     * Genera el estado de cuenta de comercio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edoCtaVehiculo(Request $request)
    {        
        //if(!$request->ajax()) return redirect('/');
        $saldo = 0;

        $vehiculo = Vehiculo::find($request->idvehiculo);
        $tipoVehiculo = TipoContribuyenteVehiculo::find($vehiculo->idtipocontribuyentevehiculo);
     
        $declaracionEstatus = DeclaracionVehiculo::where("idvehiculo", "=", $request->idvehiculo)->get();

        foreach ($declaracionEstatus as $key => $declaracion) {
            if( $declaracion->estado == "calculado" ) {
                $declaracionVehiculo = DeclaracionVehiculo::join('periodos', 'declaracion_vehiculo.idperiodo', '=', 'periodos.id')
                                    ->join('vehiculos', 'declaracion_vehiculo.idvehiculo', '=', 'vehiculos.id')
                                    ->selectRaw('periodos.periodo, vehiculos.id as idvehiculo, vehiculos.placa, vehiculos.denominacion, vehiculos.serial, vehiculos.direccion, vehiculos.rif, declaracion_vehiculo.estado, declaracion_vehiculo.monto_impuesto as monto_impuesto')
                                    ->where("declaracion_vehiculo.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionVehiculo->monto_impuesto;

                $declaracionObj[] = [
                    "periodo" => $declaracionVehiculo->periodo,
                    "estado" => $declaracion->estado,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionVehiculo->monto_impuesto
                ];
            } elseif($declaracion->estado == "pagado") {

                $declaracionVehiculo = DeclaracionVehiculo::join('periodos', 'declaracion_vehiculo.idperiodo', '=', 'periodos.id')
                                    ->join('pagos', 'declaracion_vehiculo.idpago', '=', 'pagos.id')
                                    ->join('vehiculos', 'declaracion_vehiculo.idvehiculo', '=', 'vehiculos.id')
                                    ->selectRaw('periodos.periodo, vehiculos.id as idvehiculo, vehiculos.placa, vehiculos.denominacion, vehiculos.direccion, vehiculos.rif, declaracion_vehiculo.idvehiculo, declaracion_vehiculo.estado, pagos.monto as monto_impuesto, pagos.referencia, pagos.banco')
                                    ->where("declaracion_vehiculo.id", "=", $declaracion->id)->first();

                    $saldo = $saldo + $declaracionVehiculo->monto_impuesto;

                $declaracionObj[] = [
                    "periodo" => $declaracionVehiculo->periodo,
                    "estado" => $declaracion->estado,
                    "tipo" => "abono",
                    "saldo" => $saldo,
                    "monto_impuesto" => $declaracionVehiculo->monto_impuesto
                ];
            }
        } 

        $pdf = \PDF::loadView('pdf.edoCtaVehiculo', ['declaracionObj' => $declaracionObj, 'vehiculo' => $vehiculo, 'tipoVehiculo' => $tipoVehiculo ]);
            return $pdf->download('EstadoCtaVehiculo.pdf');
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

        $declaracionVehiculo = DeclaracionVehiculo::findOrFail($id);   
        $declaracionVehiculo->delete();
    }
}
