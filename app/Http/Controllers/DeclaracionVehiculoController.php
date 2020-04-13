<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Periodo;
use App\DeclaracionVehiculo;
use App\TipoContribuyenteVehiculo;

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
        
        $declaracionesVehiculo = DeclaracionVehiculo::orderBy('ID', 'DESC')->paginate();
         
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
                $declaracionVehiculo->monto_impuesto = $monto_impuesto;
                $declaracionInmueble->estado = "calculado";
                $declaracionVehiculo->save();   
            }              
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
