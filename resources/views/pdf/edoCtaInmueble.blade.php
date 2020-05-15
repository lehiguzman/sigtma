<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estado de cuenta</title>
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
            <td width="30%" style="text-align: center;" >
                <img src="./img/logo-alcaldia.png" style="height: 80px;">            
            </td>            
            <td width="40%" style="text-align: center;"><b>ESTADO DE CUENTA INMUEBLES</b></td>
            <td width="30%" style="text-align: center;">
                <img src="./img/samat.png" style="margin-top:40px; height: 100px; width: 140px;">
            </td>
        </tr>
    </table>    
    <div>
        <table width="100%" style="border-collapse: collapse; padding-top: 25px; font-size: 14px;">
            <tr>
                <td class="bordes" width="30%" style="height: 30px;">
                    Nombre Propietario
                </td>
                <td class="bordes" width="70%" colspan="5" style="height: 30px;">
                    {{ $inmueble->denominacion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" style="height: 40px;" width="30%">
                    Dirección
                </td>
                <td class="bordes" style="height: 40px;" width="70%" colspan="5">
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
                <td class="bordes" width="25%" colspan="3">
                    {{ $inmueble->numero_civico }}
                </td>             
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Zona
                </td>
                <td class="bordes" width="25%">
                    {{ $inmueble->nombre }}
                </td> 
                 <td class="bordes" width="25%" style="text-align: center;">
                    Número Inscripción
                </td>
                <td class="bordes" width="25%" colspan="3">
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
                <td class="bordes" width="25%" colspan="3">
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
                <td class="bordes" width="12%" style="text-align: center;">
                    Teléfonos :
                </td>
                <td class="bordes" width="13%">
                    {{ $inmueble->telefono }}
                </td>
                <td class="bordes" width="12%" style="text-align: center;">
                    Cédula :
                </td>
                <td class="bordes" width="13%">
                    {{ $inmueble->rif }}
                </td>      
            </tr>
            <tr>
                <td class="bordes" width="30%" style="padding-left: 10px;">
                    Impreso por :
                </td>
                <td class="bordes" colspan="5" width="30%">
                    {{ $nombre }}
                </td>                              
            </tr>                        
        </table>
    </div>
    <div style="padding-top: 30px;">
        <table width="100%" style="border-collapse: collapse; font-size: 14px;">            
            <tr>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Fecha</b>
                </td>                
                <td class="bordes" width="40%" style="text-align: center;">
                    <b>Descripción del Movimiento</b>
                </td>               
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Cargos</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Abonos</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Saldo</b>
                </td>
            </tr>
            @foreach($declaracionObj as $declaracion)
            <tr style="font-size: 12px;">
                 <td class="bordes" width="15%" style="text-align: center;">
                    {{ $declaracion['fecha'] }}
                </td>                           
                <td class="bordes" width="40%" style="text-align: center;">
                    Cargo inmueble Año {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['monto_impuesto'], 2) }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;"></td>
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['saldo'], 2) }}
                </td>
            </tr>
            @if( $declaracion['estado'] == "pagado" && $declaracion['periodo'] == "2020")
            <tr style="font-size: 12px;"> 
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ $declaracion['fecha'] }}
                </td>                       
                <td class="bordes" width="40%" style="text-align: center;">
                    Pago Anualidades Inmuebles Urbanos {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;"></td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['monto_pago'], 2) }}
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($saldoFinal, 2) }}
                </td>
            </tr>
            @endif
            @endforeach
            <tr style="font-size: 12px; bottom: 0">                                
                <td class="bordes" width="85%" colspan="4" style="text-align: right; padding-right: 10px;">
                    <b>Saldo Final Bs.</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format( $saldoFinal, 2 ) }}
                </td>
            </tr>
        </table>
    </div> 
</body>
</html>