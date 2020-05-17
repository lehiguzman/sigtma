<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solvencia de pagos</title>
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
            <tr>
                <td class="bordes" width="30%" style="padding-left: 10px;">
                    Impreso por :
                </td>
                <td class="bordes" colspan="3" width="30%">
                    {{ $nombre }}
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
                    <b>Número de Referencia</b>
                </td>               
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Fecha</b>
                </td>
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Banco</b>
                </td>
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Monto</b>
                </td>
            </tr>
            @foreach($pagos as $pago)
            <tr style="font-size: 12px;">
                @if($pago->tipo_pago == 1)
                <td class="bordes" width="20%" style="text-align: center;">                    
                    Depósito
                </td>
                @else
                <td class="bordes" width="20%" style="text-align: center;">                    
                    Punto de venta 
                </td>
                @endif                              
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ $pago['referencia'] }}
                </td>                
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ $pago['fecha_pago'] }}
                </td>
                
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ $pago['banco'] }}
                </td>                
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ number_format($pago['monto'], 2) }}
                </td>                
            </tr>           
            @endforeach
        </table>
    </div>
</body>
</html>