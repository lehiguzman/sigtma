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
            <td width="40%" style="text-align: center;"><b>Estado de Cuenta Vehículos</b></td>
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
                <td class="bordes" width="70%" colspan="3" style="height: 30px;">
                    {{ $vehiculo->denominacion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" style="height: 40px;" width="30%">
                    Dirección
                </td>
                <td class="bordes" style="height: 40px;" width="70%" colspan="3">
                    {{ $vehiculo->direccion }}
                </td>            
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Placa
                </td>
                <td class="bordes" width="25%">
                    {{ $vehiculo->placa }}
                </td> 
                 <td class="bordes" width="25%" style="text-align: center;">
                    Serial
                </td>
                <td class="bordes" width="25%">
                    {{ $vehiculo->serial }}
                </td>             
            </tr>
            <tr>
                <td class="bordes" width="25%" style="padding-left: 10px;">
                    Tipo de Vehiculo
                </td>
                <td class="bordes" width="25%">
                    {{ $tipoVehiculo->tipo }}
                </td> 
                 <td class="bordes" width="25%" style="text-align: center;">
                    Rif
                </td>
                <td class="bordes" width="25%">
                    {{ $vehiculo->rif }}
                </td>             
            </tr>                        
        </table>
    </div> 
    <div style="padding-top: 30px;">
        <table width="100%" style="border-collapse: collapse; font-size: 14px;">            
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
                    Cargo inmueble Pago Año {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['monto_impuesto'], 2) }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;"></td>
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($declaracion['saldo'], 2) }}
                </td>
            </tr>
            @if( $declaracion['estado'] == "pagado")
            <tr style="font-size: 12px;">
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ $declaracion['periodo'] }}
                </td>                
                <td class="bordes" width="55%" style="text-align: center;">
                    Pago Anualidades Vehiculo {{ $declaracion['periodo'] }}
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