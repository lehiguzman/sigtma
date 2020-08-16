<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comparacion;

class ComparacionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $comparacion = new Comparacion();
        
        $comparacion->valor1 = $request->valor1;        
        $comparacion->valor2 = $request->valor2;        
        $comparacion->resultado = $request->resultado;        
        $comparacion->intentos = $request->intentos;
        $comparacion->idregistro = $request->idregistro;        
        $comparacion->save();
    } 
}
