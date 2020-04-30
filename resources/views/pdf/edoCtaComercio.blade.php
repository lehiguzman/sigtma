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
            <td width="40%" style="text-align: center;"><b>Estado de Cuenta Actividad Económica</b></td>
            <td width="30%" style="text-align: center;">
                <img src="./img/samat.png" style="margin-top:40px; height: 100px; width: 140px;">
            </td>
        </tr>
    </table>    
    <div>
        <table width="100%" style="border-collapse: collapse; padding-top: 25px;">
            <tr>
                <td class="bordes" width="30%">
                    Denominación comercial :
                </td>
                <td class="bordes" width="70%" colspan="3">
                    {{ $comercio->denominacion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" width="30%">
                    Dirección :
                </td>
                <td class="bordes" width="70%" colspan="3">
                    {{ $comercio->direccion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" width="30%" style="padding-left: 10px;">
                    Telefonos :
                </td>
                <td class="bordes" width="30%">
                    {{ $comercio->telefono }}
                </td> 
                 <td class="bordes" width="20%" style="text-align: center;">
                    Cédula/Rif :
                </td>
                <td class="bordes" width="20%">
                    {{ $comercio->rif }}
                </td>             
            </tr>
            <tr>
                <td class="bordes" width="30%" style="padding-left: 10px;">
                    Tributo :
                </td>
                <td class="bordes" width="30%">
                    Actividad Económica
                </td> 
                 <td class="bordes" width="20%" style="text-align: center;">
                    Licencia :
                </td>
                <td class="bordes" width="20%">
                    {{ $comercio->licencia }}
                </td>             
            </tr>
        </table>
    </div>    
    <div style="padding-top: 30px;">
        <table width="100%" style="border-collapse: collapse; font-size: 10px;">
            <tr>
                <td class="bordes" width="100%" style="text-align: center; height: 3%;" colspan="4">
                    <b>RAMO(S) AUTORIZADO(S) A EXPLOTAR</b>
                </td>
            </tr>
            <tr>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>CODIGO</b>
                </td>
                <td class="bordes" width="55%" style="text-align: center;">
                    <b>DESCRIPCIÓN</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>ALíCUOTA (%)</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>MíNIMO (UT)</b>
                </td>
            </tr>
            @foreach($ramas as $rama)
            <tr>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>{{ $rama['codigo'] }}</b>
                </td>
                <td class="bordes" width="55%" style="text-align: center;">
                    <b>{{ $rama['descripcion']}}</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>{{ $rama['alicuota_anual'] }}</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>{{ $rama['minimo_tributable'] }}</b>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div style="padding-top: 30px;">
        <table width="100%" style="border-collapse: collapse; font-size: 10px;">            
            <tr>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Periodo</b>
                </td>
                <td class="bordes" width="55%" style="text-align: center;">
                    <b>Descripción del Movimiento</b>
                </td>               
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Abonos</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Cargos</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Saldo</b>
                </td>
            </tr>
            @foreach($declaracionObj as $declaracion)
            <tr style="font-size: 12px;">
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="55%" style="text-align: center;">
                    Cargo Actividad Económica Pago Año {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['monto_impuesto'], 2) }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;"></td>
                @if($declaracion["estado"] == "calculado")
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['monto_impuesto'], 2) }}
                </td>
                @else
                <td class="bordes" width="15%" style="text-align: center;">
                    0.00
                </td>
                @endif
            </tr>
            @if( $declaracion['estado'] == "pagado")
            <tr style="font-size: 12px;">
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="55%" style="text-align: center;">
                    Pago Anualidades Inmuebles Urbanos {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;"></td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['monto_impuesto'], 2) }}
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    0.00
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</body>
</html>