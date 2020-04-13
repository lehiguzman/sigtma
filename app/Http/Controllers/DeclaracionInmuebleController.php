<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeclaracionInmueble;
use App\Periodo;
use App\Inmueble;
use App\Regimen;
use App\Zona;

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
        
        $declaracionesInmueble = DeclaracionInmueble::orderBy('ID', 'DESC')->paginate();
         
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

        $declaracionInmueble = new DeclaracionInmueble();

        $declaracionInmueble->idinmueble = $request->idinmueble;
        $declaracionInmueble->idperiodo = $request->idperiodo;
        $declaracionInmueble->idzona = $request->idzona;    
        $declaracionInmueble->tipo_vivienda = $request->tipo_vivienda;
        $declaracionInmueble->idregimen = $request->idregimen;
        $declaracionInmueble->area_terreno = $request->area_terreno;
        $declaracionInmueble->area_construccion = $request->area_construccion;
        $declaracionInmueble->valor_total = $request->valor_total;
        $declaracionInmueble->monto_impuesto = $request->monto_impuesto;
        $declaracionInmueble->estado = "calculado";
        $declaracionInmueble->save();       
         
    }

    public function selectDeclaracion(Request $request, $id) {

        //$date = new \DateTime('now');  

    	$inmueble = Inmueble::find($id);       
        $declaracionInmueble = declaracionInmueble::where("idinmueble", "=", $inmueble->id)->orderBy("idperiodo", 'DESC')->first();
        
        if($declaracionInmueble == NULL) {
            $ultimo_anio = "N/A";
            $periodo = Periodo::orderBy('ID', 'ASC')->first();
        } else {
            $periodo = Periodo::find($declaracionInmueble->idperiodo);
            $ultimo_anio = $periodo->periodo;
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
