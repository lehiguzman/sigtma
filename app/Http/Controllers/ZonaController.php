<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zona;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $zonas = Zona::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $zonas = Zona::find($request->id);                
        }    
        return [ 
            'zonas' => $zonas
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
        $zona = new Zona();       
        
        $zona->nombre = $request->nombre;                
        $zona->c1 = $request->c1;
        $zona->c2 = $request->c2;
        $zona->c3 = $request->c3;
        $zona->c4 = $request->c4;      
        $zona->v1 = $request->v1;      
        $zona->v2 = $request->v2;      
        $zona->v3 = $request->v3;      
        $zona->v4 = $request->v4; 
        $zona->save();        
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

        $zona = Zona::findOrFail($request->id);        
       	$zona->nombre = $request->nombre;                
        $zona->c1 = $request->c1;
        $zona->c2 = $request->c2;
        $zona->c3 = $request->c3;
        $zona->c4 = $request->c4;      
        $zona->v1 = $request->v1;      
        $zona->v2 = $request->v2;      
        $zona->v3 = $request->v3;      
        $zona->v4 = $request->v4;        
        $zona->save();  
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

        $zona = Zona::findOrFail($id);   
        $zona->delete();
    }
}
