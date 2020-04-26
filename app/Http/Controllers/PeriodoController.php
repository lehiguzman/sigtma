<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $periodos = Periodo::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $periodos = Periodo::find($request->id);                
        }    
        return [ 
            'periodos' => $periodos
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
        $periodo = new Periodo();        
        
        $periodo->periodo = $request->periodo;
        $periodo->unidad_tributaria = $request->unidad_tributaria;
        $periodo->save();        
    } 

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        $periodo = Periodo::findOrFail($request->id);        
        $periodo->periodo = $request->periodo;        
        $periodo->unidad_tributaria = $request->unidad_tributaria;             
        $periodo->save();
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

        $periodo = Periodo::findOrFail($id);   
        $periodo->delete();
    }
}
