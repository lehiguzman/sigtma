<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Multiplica;

class MultiplicaController extends Controller
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
        $multiplica = new Multiplica();                
        
        $multiplica->valor1 = $request->valor1;        
        $multiplica->valor2 = $request->valor2;        
        $multiplica->resultado = $request->resultado;                
        $multiplica->idregistro = $request->idregistro;        
        $multiplica->save();
    } 
}
