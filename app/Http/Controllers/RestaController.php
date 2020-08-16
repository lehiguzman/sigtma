<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resta;

class RestaController extends Controller
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
        $resta = new Resta();
        
        $resta->valor1 = $request->valor1;        
        $resta->valor2 = $request->valor2;        
        $resta->resultado = $request->resultado;        
        $resta->intentos = $request->intentos;
        $resta->idregistro = $request->idregistro;        
        $resta->save();
    } 
}
