<?php

namespace App\Http\Controllers;
use App\Registro;

use Illuminate\Http\Request;


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
}
