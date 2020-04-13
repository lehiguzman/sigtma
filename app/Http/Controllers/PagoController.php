<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $pagos = Pago::orderBy('ID', 'DESC')->paginate();

        if($request->id) {
            $pagos = Pago::find($request->id);                
        }    
        return [ 
            'pagos' => $pagos
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
        $pago = new Pago();     

        $date = new \DateTime($request->fecha_pago);     
        
        $pago->tipo_pago = $request->tipo_pago;
        $pago->referencia = $request->referencia;
        $pago->banco = $request->banco;
        $pago->fecha_pago = $date->format('Y-m-d');
		$pago->tipo_contribuyente = $request->tipo_contribuyente;
        $pago->monto = $request->monto_pago;
        $pago->save();        
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

        $pago = Pago::findOrFail($request->id);        
        $pago->tipo_pago = $request->tipo_pago;
        $pago->referencia = $request->referencia;
        $pago->banco = $request->banco;
        $pago->fecha_pago = $request->fecha_pago;
		$pago->tipo_contribuyente = $request->tipo_contribuyente;
        $pago->monto = $request->monto_pago;
        $pago->save();    
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

        $pago = Pago::findOrFail($id);   
        $pago->delete();
    }
}
