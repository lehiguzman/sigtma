<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regimen;

class RegimenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $regimenes = Regimen::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $regimenes = Regimen::find($request->id);                
        }    
        return [ 
            'regimenes' => $regimenes
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
        $regimen = new Regimen();       
        
        $regimen->regimen = $request->regimen;                
        $regimen->alicuota = $request->alicuota;        
        $regimen->save();        
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

        $regimen = Regimen::findOrFail($request->id);        
       	$regimen->regimen = $request->regimen;                
        $regimen->alicuota = $request->alicuota;        
        $regimen->save();
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

        $regimen = Regimen::findOrFail($id);   
        $regimen->delete();
    }
}
