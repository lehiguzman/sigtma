<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitacora de usuario</title>
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
                    Sede :
                </td>
                <td class="bordes" width="70%" colspan="3">
                    Barinas
                </td>            
            </tr>           
        </table>
    </div>        
    <div style="padding-top: 30px;">
        <table width="100%" style="border-collapse: collapse; font-size: 10px;">            
            <tr>
                <td class="bordes" width="20%" style="text-align: center;">
                    <b>Usuario</b>
                </td>
                <td class="bordes" width="50%" style="text-align: center;">
                    <b>Descripción del Movimiento</b>
                </td>               
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Fecha</b>
                </td>
                <td class="bordes" width="15%" style="text-align: center;">
                    <b>Hora</b>
                </td>                
            </tr>
            @foreach($bitacoraObj as $bitacora)
            <tr style="font-size: 12px;">
                <td class="bordes" width="20%" style="text-align: center;">
                    {{ $bitacora->name }}
                </td>                
                <td class="bordes" width="50%" style="text-align: center;">
                    {{ $bitacora->accion }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ date('d-m-y', strtotime($bitacora->fecha)) }}
                </td>                
                <td class="bordes" width="15%" style="text-align: center;">
                    {{ date('h:s', strtotime($bitacora->fecha)) }}
                </td>
            </tr>            
            @endforeach
        </table>
    </div>
</body>
</html>