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
                <td class="bordes" width="40%" style="text-align: center;">
                    <b>Número de comprobante</b>
                </td>               
                <td class="bordes" width="25%" style="text-align: center;">
                    <b>Fecha</b>
                </td>                
                <td class="bordes" width="35%" style="text-align: center;">
                    <b>Monto</b>
                </td>
            </tr>            
            <tr style="font-size: 12px;">                                
                <td class="bordes" width="40%" style="text-align: center;">
                    {{ $pago->comprobante }}
                </td>                
                <td class="bordes" width="25%" style="text-align: center;">
                    {{ $pago->created_at }}
                </td>                      
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ number_format($pago->monto, 2) }}
                </td>                
            </tr>            
        </table>
    </div>
</body>
</html>