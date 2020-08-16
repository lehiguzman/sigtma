<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Suma;

class SumaController extends Controller
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
        $suma = new Suma();                
        
        $suma->valor1 = $request->valor1;        
        $suma->valor2 = $request->valor2;        
        $suma->resultado = $request->resultado;        
        $suma->intentos = $request->intentos;
        $suma->idregistro = $request->idregistro;        
        $suma->save();
    } 
}
