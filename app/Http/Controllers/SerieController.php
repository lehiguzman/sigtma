<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Serie;

class SerieController extends Controller
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
        $serie = new Serie();
        
        $serie->valor1 = $request->valor1;        
        $serie->valor2 = $request->valor2;
        $serie->valor3 = $request->valor3;
        $serie->valor4 = $request->valor4;
        $serie->valor5 = $request->valor5;
        $serie->resultado1 = $request->resultado1;        
        $serie->resultado2 = $request->resultado2;                
        $serie->idregistro = $request->idregistro;        
        $serie->save();
    } 
}
