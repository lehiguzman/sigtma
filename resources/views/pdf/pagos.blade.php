<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ausencias</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;            
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: center;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;            
        }
        .table-striped tbody tr:nth-of-type(odd) {
            text-align: center;
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="30%">
                <img src="./img/logo-alcaldia.png" style="margin: 15px; height: 80px;">            
            </td>
            <td width="50%"></td>
            <td width="20%">
                <img src="./img/samat.png" style="margin-top:40px; margin-right: 60px; height: 100px; width: 140px;">
            </td>
        </tr>
    </table>    
    <div>
        <table width="100%">
            <tr>
                <td style="text-align: center;">
                   <b><h3>  Lista de Pagos por Usuario</h3></b>
                </td>                
            </tr>            
        </table>
        <table class="table table-bordered table-striped table-sm" width="100%">
            <thead>
                <tr>
                    <th width="10%">Comprobante</th>                    
                    <th width="10%">Fecha</th>
                    <th width="10%">Hora</th>
                    <th width="20%">Tipo de impuesto</th>                                        
                    <th width="10%">Contribuyente</th>                    
                    <th width="10%">Usuario</th>           
                    <th width="10%">Banco</th>
                    <th width="10%">Referencia</th>
                    <th width="10%">Monto</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos as $pago)
                <tr>                    
                    <td width="10%">{{$pago['comprobante']}}</td>                    
                    <td width="10%">{{ date('d-m-y', strtotime($pago['fecha'])) }}</td>
                    <td width="10%">{{ date('h:s', strtotime($pago['fecha'])) }}</td>
                    @if($pago['tipo_declaracion'] == 1) {
                        <td width="20%">Estimada</td>
                    }
                    @else {
                        <td width="20%">Definitiva</td>
                    }
                    @endif
                    <td width="10%">{{$pago['codigo']}}</td>                     
                    <td width="10%">{{$pago['usuario']}}</td> 
                    <td width="10%">{{$pago['banco']}}</td>
                    <td width="10%">{{$pago['referencia']}}</td>                     
                    <td width="10%">{{ number_format($pago['monto']) }}</td>                    
                </tr>
                @endforeach                               
            </tbody>
        </table>
    </div>    
</body>
</html>