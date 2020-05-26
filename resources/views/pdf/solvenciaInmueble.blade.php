<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solvencia de pago</title>
    <style>
        .bordes {
            border: 0.5px solid;           
            padding-left: 10px;        
        }        
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="25%" style="text-align: center;" >
                <img src="./img/logo-alcaldia.png" style="height: 80px;">            
            </td>            
            <td width="45%" style="text-align: center;"><b>SOLVENCIA DE PAGO</b></td>
            <td width="30%" style="text-align: center;">
                <img src="./img/samat.png" style="margin-top:40px; height: 100px; width: 140px;">
            </td>
        </tr>
    </table>    
    <div>
        <table width="100%" style="border-collapse: collapse; padding-top: 25px;">
            <tr>
                <td class="bordes" width="30%" style="height: 30px;">
                    Nombre Propietario
                </td>
                <td class="bordes" width="70%" colspan="3" style="height: 30px;">
                    {{ $inmueble->denominacion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" style="height: 40px;" width="30%">
                    Dirección
                </td>
                <td class="bordes" style="height: 40px;" width="70%" colspan="3">
                    {{ $inmueble->direccion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Código catastral
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->codigo_catastral }}
                </td> 
                 <td class="bordes" width="25%" style="text-align: center;">
                    Número Civico
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->numero_civico }}
                </td>             
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Teléfono
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->telefono }}
                </td> 
                 <td class="bordes" width="25%" style="text-align: center;">
                    Número Inscripción
                </td>
                <td class="bordes" width="25%" >
                    {{ $inmueble->numero_inscripcion }}
                </td>             
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Área Terreno :
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->area_terreno }}
                </td> 
                 <td class="bordes" width="25%" style="text-align: center;">
                    Área Construcción :
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->area_construccion }}
                </td>             
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Tipo de Vivienda
                </td>
                <td class="bordes" width="25%">
                    {{ $inmuebleTipo->regimen }}
                </td>                
                <td class="bordes" width="25%" style="text-align: center;">
                    Cédula :
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->rif }}
                </td>      
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Impreso por :
                </td>
                <td class="bordes" width="25%">
                    {{ $nombre }}
                </td>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Nro Comprobante :
                </td>
                <td class="bordes" width="25%">
                    {{ $pago->comprobante }}
                </td>                           
            </tr>
        </table>
    </div>    
    <div style="padding-top: 30px;">
         <table width="100%" style="border-collapse: collapse; font-size: 10px;">            
            <tr>  
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Tipo de pago</b>
                </td>    
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Referencia</b>
                </td>               
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Fecha</b>
                </td>                           
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>banco</b>
                </td> 
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Monto</b>
                </td>
            </tr>   
            @foreach($pagos as $pago)         
            <tr style="font-size: 12px;">                                
                @if($pago->tipo_pago == 1)
                <td class="bordes" width="20%" style="text-align: center;">                    
                    Deposito
                </td>
                @else
                <td class="bordes" width="20%" style="text-align: center;">                    
                    Punto de venta 
                </td>
                @endif 
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ $pago->referencia }}
                </td>                
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ date('d-m-y', strtotime($pago->fecha_pago)) }}
                </td>                 
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ $pago->banco }}
                </td>                      
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ number_format($pago->monto, 2) }}
                </td>                
            </tr>
            @endforeach      
        </table>
    </div>
</body>
</html>