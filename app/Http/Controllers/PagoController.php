<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use App\Pago;
use App\User;
use App\Comercio;
use App\Inmueble;
use App\Vehiculo;
use App\DeclaracionComercio;
use App\DeclaracionInmueble;
use App\DeclaracionVehiculo;
use App\TipoContribuyenteVehiculo;
use App\DetallePago;
use App\Bitacora;
use App\Regimen;

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
     * Historico de Pagos de un comercio
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function historicoComercio(Request $request) {

        $nombre = Auth::user()->name;
        $comercio = Comercio::find($request->idcomercio);
        $pagos = DeclaracionComercio::join("pagos", "declaracion_comercio.idpago", "=", "pagos.id")
                                    ->join("detalle_pagos", "pagos.id", "=", "detalle_pagos.idpago")
                                    ->selectRaw('distinct(declaracion_comercio.idpago), detalle_pagos.referencia, detalle_pagos.fecha_pago, detalle_pagos.banco, detalle_pagos.monto, detalle_pagos.tipo_pago')
                                    ->where('declaracion_comercio.idcomercio', '=', $request->idcomercio)
                                    ->get();

         //$pdf = \PDF::loadView('pdf.historicoComercio', ['comercio' => $comercio , 'pagos' => $pagos, 'nombre' => $nameUser ]);
           //         return $pdf->download('historicoComercio.pdf');

        $view =  \View::make('pdf.historicoComercio', compact('comercio', 'pagos', 'nombre'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }    

    /**
     * Historico de Pagos de un Inmueble
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function historicoInmueble(Request $request) {

        $nombre = Auth::user()->name;
        $inmueble = Inmueble::find($request->idinmueble);
        $pagos = DeclaracionInmueble::join("pagos", "declaracion_inmueble.idpago", "=", "pagos.id")
                                    ->join("detalle_pagos", "pagos.id", "=", "detalle_pagos.idpago")
                                    ->selectRaw('distinct(declaracion_inmueble.idpago), detalle_pagos.referencia, detalle_pagos.fecha_pago, detalle_pagos.banco, detalle_pagos.monto, detalle_pagos.tipo_pago')
                                    ->where('declaracion_inmueble.idinmueble', '=', $request->idinmueble)
                                    ->get();

        $view =  \View::make('pdf.historicoInmueble', compact('inmueble', 'pagos', 'nombre'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('historicoInmueble');
    }  

    /**
     * Historico de Pagos de un Inmueble
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function historicoVehiculo(Request $request) {

        $nombre = Auth::user()->name;
        $vehiculo = Vehiculo::find($request->idvehiculo);
        $pagos = DeclaracionVehiculo::join("pagos", "declaracion_vehiculo.idpago", "=", "pagos.id")
                                    ->join("detalle_pagos", "pagos.id", "=", "detalle_pagos.idpago")
                                    ->selectRaw('distinct(declaracion_vehiculo.idpago), detalle_pagos.referencia, detalle_pagos.fecha_pago, detalle_pagos.banco, detalle_pagos.monto, detalle_pagos.tipo_pago')
                                    ->where('declaracion_vehiculo.idvehiculo', '=', $request->idvehiculo)
                                    ->get();

        $view =  \View::make('pdf.historicoVehiculo', compact('vehiculo', 'pagos', 'nombre'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('historicoVehiculo');
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

        $date = new \DateTime('now');
        $user_id = Auth::user()->id;  

        $detalles = $request->detalles; 

        try{
            DB::beginTransaction();   
        
            //$pago->tipo_pago = $request->tipo_pago;
            //$pago->referencia = $request->referencia;
            //$pago->banco = $request->banco;
            //$pago->fecha_pago = $date->format('Y-m-d');
    		    

            if($request->tipo_contribuyente == 'comercio') {
                $comercio = Comercio::find($request->idcomercio);
                $declaraciones = DeclaracionComercio::where('idcomercio', '=', $request->idcomercio)->where('estado', '=', 'calculado')->get();
              
              $accion = 'Registra Pago Contribuyente : '. $comercio->denominacion;
                Bitacora::create([
                    'accion' => $accion,
                    'codigo' => $comercio->rif,
                    'tipo_contribuyente' => 'comercio',
                    'iduser' => $user_id,            
                ]);

                $codigo = $comercio->rif.$date->format('dmY');
            } 

            if($request->tipo_contribuyente == 'inmueble') {
                $inmueble = Inmueble::find($request->idinmueble);
                $declaraciones = DeclaracionInmueble::where('idinmueble', '=', $request->idinmueble)->where('estado', '=', 'calculado')->get();

                 $accion = 'Registra Pago Contribuyente : '. $inmueble->denominacion;
                  Bitacora::create([
                      'accion' => $accion,
                      'codigo' => $inmueble->codigo_catastral,
                      'tipo_contribuyente' => 'inmueble',
                      'iduser' => $user_id,            
                  ]);

                  $codigo = $inmueble->codigo_catastral.$date->format('dmY');
            }

            if($request->tipo_contribuyente == 'vehiculo') {
                $vehiculo = Vehiculo::find($request->idvehiculo);
                $declaraciones = DeclaracionVehiculo::where('idvehiculo', '=', $request->idvehiculo)->where('estado', '=', 'calculado')->get();
                $accion = 'Registra Pago Contribuyente : '. $vehiculo->denominacion;
                  Bitacora::create([
                      'accion' => $accion,
                      'codigo' => $vehiculo->placa,
                      'tipo_contribuyente' => 'vehiculo',
                      'iduser' => $user_id,            
                  ]);

                  $codigo = $vehiculo->placa.$date->format('dmY');
            }          

            $pago = new Pago();
            $pago->tipo_contribuyente = $request->tipo_contribuyente;
            $pago->monto = $request->monto_pago;
            $pago->comprobante = $codigo;
            $pago->user_id = $user_id;
            $pago->save(); 

            $idpago = $pago->id;

            foreach ($detalles as $a => $det) {

              $fechaPago = new \DateTime($det['fecha_pago']);

              $detalle = new DetallePago();
              $detalle->idpago = $pago->id;
              $detalle->tipo_pago = $det['tipoPago'];
              $detalle->referencia = $det['referencia'];
              $detalle->fecha_pago = $fechaPago;
              $detalle->banco = $det['banco'];
              $detalle->monto = $det['monto_pago'];
              $detalle->save();
            }

            foreach ($declaraciones as $key => $declaracion) {
              $declaracion->idpago = $pago->id;
              $declaracion->estado = "pagado";
              $declaracion->save();
            } 

            DB::commit();

        } catch (Exception $e){

            DB::rollBack();
        }

        return $idpago;
    } 


    /**
     * Reporte de pagos por usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bitacora(Request $request)
    {  
        $fecha_desde = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_desde);
        $fecha_hasta = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_hasta); 

        if($request->fecha_desde && $request->fecha_hasta) {
          if( $request->user_id == "todos" ) {
            $bitacora = Bitacora::join("users", "bitacoras.iduser", "=", "users.id")
              ->selectRaw('users.name, bitacoras.created_at as fecha, bitacoras.accion, bitacoras.codigo')
              ->whereDate("bitacoras.created_at", '>=', $fecha_desde->format('Y-m-d'))
              ->whereDate("bitacoras.created_at", '<=', $fecha_hasta->format('Y-m-d'))
              ->orderBY('bitacoras.ID', 'ASC')->get();
          } else {
             $bitacora = Bitacora::join("users", "bitacoras.iduser", "=", "users.id")
              ->selectRaw('users.name, bitacoras.created_at as fecha, bitacoras.accion, bitacoras.codigo')
              ->where("iduser", '=', $request->user_id)
              ->whereDate("bitacoras.created_at", '>=', $fecha_desde->format('Y-m-d'))
              ->whereDate("bitacoras.created_at", '<=', $fecha_hasta->format('Y-m-d'))
              ->orderBY('bitacoras.ID', 'ASC')->get();
          }
        } else {
            $hoy = date('Y-m-d');            
            if( $request->user_id == "todos" ) {
              $bitacora = Bitacora::join("users", "bitacoras.iduser", "=", "users.id")
              ->selectRaw('users.name, bitacoras.created_at as fecha, bitacoras.accion, bitacoras.codigo')
              ->whereDate('bitacoras.created_at', '=', $hoy)
              ->orderBY('bitacoras.ID', 'ASC')
              ->get();    
            } else {
              $bitacora = Bitacora::join("users", "bitacoras.iduser", "=", "users.id")
              ->selectRaw('users.name, bitacoras.created_at as fecha, bitacoras.accion')
              ->where("iduser", '=', $request->user_id)
              ->whereDate('bitacoras.created_at', '=', $hoy)
              ->orderBY('bitacoras.ID', 'ASC')->get();       
            }            
        }

        if($request->accion == "generar") {
            return  $bitacora;        
        } 
        else {            
            $pdf = \PDF::loadView('pdf.bitacora', ['bitacoraObj' => $bitacora]);
            return $pdf->download('pagos.pdf');
        }
    }

    /**
     * Reporte de pagos por usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportePagos(Request $request)
    {     
        
        $fecha_desde = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_desde);
        $fecha_hasta = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_hasta);       

        $pagos = NULL;

        if($request->fecha_desde && $request->fecha_hasta) {
          if( $request->user_id == "todos" ) {
            $pagosA = Pago::whereDate("created_at", '>=', $fecha_desde->format('Y-m-d'))
              ->whereDate("created_at", '<=', $fecha_hasta->format('Y-m-d'))->orderBY('ID', 'ASC')->get();
          } else {
             $pagosA = Pago::where("user_id", '=', $request->user_id)->whereDate("created_at", '>=', $fecha_desde->format('Y-m-d'))
              ->whereDate("created_at", '<=', $fecha_hasta->format('Y-m-d'))->orderBY('ID', 'ASC')->get();
          }
        } else {
            $hoy = date('Y-m-d');            
            if( $request->user_id == "todos" ) {
              $pagosA = Pago::whereDate('created_at', '=', $hoy)->orderBY('ID', 'ASC')->get();    
            } else {
              $pagosA = Pago::where("user_id", '=', $request->user_id)->whereDate('created_at', '=', $hoy)->orderBY('ID', 'ASC')->get();       
            }       
        }

        foreach ($pagosA as $key => $pago) {

          if($pago["tipo_contribuyente"] == "vehiculo") {
            $result = DeclaracionVehiculo::join("pagos", "declaracion_vehiculo.idpago", "=", "pagos.id")
            ->join('vehiculos', 'declaracion_vehiculo.idvehiculo', '=', 'vehiculos.id')
            ->join('users', 'pagos.user_id', '=', 'users.id')
            ->selectRaw('declaracion_vehiculo.created_at as fecha, vehiculos.placa as codigo, 
                         declaracion_vehiculo.tipo_declaracion as tipo_declaracion, 
                         pagos.id as comprobante, pagos.banco as banco, pagos.referencia as referencia, 
                         pagos.monto as monto, users.name as usuario')
            ->where("idpago", "=", $pago["id"])
            ->first();
          }

          if($pago["tipo_contribuyente"] == "inmueble") {
            $result = DeclaracionInmueble::join("pagos", "declaracion_inmueble.idpago", "=", "pagos.id")
            ->join('inmuebles', 'declaracion_inmueble.idinmueble', '=', 'inmuebles.id')
            ->join('users', 'pagos.user_id', '=', 'users.id')
            ->selectRaw('declaracion_inmueble.created_at as fecha, inmuebles.codigo_catastral as codigo, 
                         declaracion_inmueble.tipo_declaracion as tipo_declaracion, 
                         pagos.id as comprobante, pagos.banco as banco, pagos.referencia as referencia, 
                         pagos.monto as monto, users.name as usuario')
            ->where("idpago", "=", $pago["id"])
            ->first();
          }

          if($pago["tipo_contribuyente"] == "comercio") {
            $result = DeclaracionComercio::join("pagos", "declaracion_comercio.idpago", "=", "pagos.id")
            ->join('comercios', 'declaracion_comercio.idcomercio', '=', 'comercios.id')
            ->join('users', 'pagos.user_id', '=', 'users.id')
            ->selectRaw('declaracion_comercio.created_at as fecha, comercios.licencia as codigo, 
                         declaracion_comercio.tipo_declaracion as tipo_declaracion, 
                         pagos.id as comprobante, pagos.banco as banco, pagos.referencia as referencia, 
                         pagos.monto as monto, users.name as usuario')
            ->where("idpago", "=", $pago["id"])
            ->first();
          }

          $pagos[] = [
            "comprobante" => $result->comprobante,
            "tipo_declaracion" => $result->tipo_declaracion,
            "usuario" => $result->usuario,
            "codigo" => $result->codigo,
            "fecha" => $result->fecha,
            "referencia" => $result->referencia,
            "banco" => $result->banco,
            "monto" => $result->monto,
            "idperiodo" => $result->idperiodo,
          ]; 
        }        

        if($request->accion == "generar") {
            return  $pagos;        
        } 
        else {
            $user = User::find($request->user_id);
            $pdf = \PDF::loadView('pdf.pagos', ['pagos' => $pagos, 'user' => $user])->setPaper('a4', 'landscape');
            return $pdf->download('pagos.pdf');
        }
    }

    public function reporteTramites( Request $request ) {

      $fecha_desde = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_desde);
      $fecha_hasta = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_hasta);

      $iduser = Auth::user()->id;  

      if($request->fecha_desde && $request->fecha_hasta) {
          if( $request->user_id == "todos" ) {            
            $tramites = Bitacora::whereDate("created_at", '>=', $fecha_desde->format('Y-m-d'))
              ->whereDate("created_at", '<=', $fecha_hasta->format('Y-m-d'))->orderBY('ID', 'ASC')->get();
          } else {
             $tramites = Bitacora::where("user_id", '=', $request->user_id)->whereDate("created_at", '>=', $fecha_desde->format('Y-m-d'))
              ->whereDate("created_at", '<=', $fecha_hasta->format('Y-m-d'))->orderBY('ID', 'ASC')->get();
          }
        } else {
            $hoy = date('Y-m-d');            
            if( $request->user_id == "todos" ) {
              $tramites = Bitacora::whereDate('created_at', '=', $hoy)->orderBY('ID', 'ASC')->get();    
            } else {
              $tramites = Bitacora::where("iduser", "=", $iduser)->whereDate("created_at", '<=', $fecha_hasta->format('Y-m-d'))->orderBY('ID', 'ASC')->get();
            }       
        }      

      foreach ($tramites as $key => $tramite) {
        
        if( $tramite['tipo_contribuyente'] == 'comercio' ) {
          $res = Comercio::where("rif", "=", $tramite['codigo'])->first();
          $codigo = $res['rif'];
        }

        if( $tramite['tipo_contribuyente'] == 'inmueble' ) {
          $res = Inmueble::where("codigo_catastral", "=", $tramite['codigo'])->first();
          $codigo = $res['codigo_catastral'];
        }

        if( $tramite['tipo_contribuyente'] == 'vehiculo' ) {
          $res = Vehiculo::where("placa", "=", $tramite['codigo'])->first();
          $codigo = $res['placa'];
        }

        if($res) {
          $resultados[] = [
          'codigo' => $codigo,
          'denominacion' => $res['denominacion'],
          'fecha' => $res['created_at'],
          ];
        }
        
      }

      if($request->accion == "generar") {
            return  $resultados;        
        } 
        else {
            $user = User::find($request->user_id);
            $pdf = \PDF::loadView('pdf.tramites', ['resultados' => $resultados, 'user' => $user]);
            return $pdf->download('tramites.pdf');
        }
    }

    public function solvenciaComercio( Request $request ) {

      $nombre = Auth::user()->name;  

      $comercio = Comercio::find( $request->idcomercio );

      $pago = Pago::find($request->idpago);

      $view =  \View::make('pdf.solvenciaComercio', compact('nombre', 'comercio', 'pago'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('solvencia');
    } 

    public function solvenciaInmueble( Request $request ) {

      $nombre = Auth::user()->name;  

      $inmueble = Inmueble::find( $request->idinmueble );
      $inmuebleTipo = Regimen::find( $inmueble->idregimen );

      $pago = Pago::find($request->idpago);

      $view =  \View::make('pdf.solvenciaInmueble', compact('nombre', 'inmueble', 'pago', 'inmuebleTipo'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('solvencia');
    } 

    public function solvenciaVehiculo( Request $request ) {

      $nombre = Auth::user()->name;  

      $vehiculo = Vehiculo::find( $request->idvehiculo );
      $tipoVehiculo = TipoContribuyenteVehiculo::find( $vehiculo->idtipocontribuyentevehiculo );

      $pago = Pago::find($request->idpago);

      $view =  \View::make('pdf.solvenciaVehiculo', compact('nombre', 'vehiculo', 'pago', 'tipoVehiculo'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('solvencia');
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
