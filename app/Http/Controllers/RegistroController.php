<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Registro;
use App\Suma;
use App\Resta;
use App\Multiplica;
use App\Comparacion;
use App\Serie;


class RegistroController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
           
        $alumnos = Registro::orderBy('ID', 'DESC')->paginate();

        return $alumnos;
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
        $registro = new Registro();        
        
        $registro->nombre = $request->nombre;        
        $registro->save();        
    } 

    /**
     * Select the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request, $id)
    {        
        //if(!$request->ajax()) return redirect('/');              

        $alumno = Registro::findOrFail($id);   
        
        return $alumno;
    }

     /**
     * Select the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reporte(Request $request, $alumno, $ejercicio)
    {        
        //if(!$request->ajax()) return redirect('/');              

        //$reporte = Registro::findOrFail($alumno);   

        if( $ejercicio == 1 ) {
            $respuesta = Suma::where('idregistro', '=', $alumno)->get();
        } else if ( $ejercicio == 2 ) {
            $respuesta = Resta::where('idregistro', '=', $alumno)->get();
        } else if ( $ejercicio == 3 ) {
            $respuesta = Multiplica::where('idregistro', '=', $alumno)->get();
        } else if ( $ejercicio == 4 ) {
            $respuesta = Comparacion::where('idregistro', '=', $alumno)->get();
        } else if ( $ejercicio == 5 ) {
            $respuesta = Serie::where('idregistro', '=', $alumno)->get();
        }
        
        return $respuesta;
    }

}
