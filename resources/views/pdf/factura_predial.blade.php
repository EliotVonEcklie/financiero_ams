@php
    $limite = 8;
    $constante = 8;
    $periodosFacturados = array_values(array_filter($facturaPredial->data['liquidacion']['vigencias'],function($filter){
        return $filter['isSelected'] == true;
    }));
    $longitud = count($periodosFacturados);
    $tablas = round($longitud/$limite) > 0 ? round($longitud/$limite) : 1;
    $index = 0;
    $total=0;
    $periodoFacturado =$periodosFacturados[count($periodosFacturados)-1]['vigencia'].' - '.$periodosFacturados[0]['vigencia'];
@endphp

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            body {
                font-family:Arial, Helvetica, sans-serif;
            }

            p {
                font-size: 9pt;
                margin:0;
                margin-bottom:5px;
                padding: 0;
            }
            .m-0{
                margin: 0;
            }
            .t-1 {
                color:#E05A10;
            }

            .t-2 {
                color:#03071E;
            }

            .t-3 {
                color:#6D6A75;
            }

            .text-white{
                color:#fff;
            }
            .w10{
                width:10%;
            }
            .w33{
                width:33.33%;
            }
            .w55{
                width:55%;
            }
            .w50{
                width:50%;
            }
            .w15{
                width:15%;
            }
            .w100{
                width:100%;
            }
            .fs-s-1{
                font-size:6pt
            }
            .fs-0{
                font-size:7.2pt
            }
            .fs-1{
                font-size: 8pt;
            }
            .fs-2{
                font-size: 12pt;
            }
            .fs-3{
                font-size: 14pt;
            }
            .fs-4{
                font-size: 16pt;
            }
            .fs-5{
                font-size: 20pt;
            }
            .fw-bold{
                font-weight: bold;
            }
            .fw-semibold{
                font-weight:500;
            }
            .p-1{
                padding: 5px 10px;
            }
            hr{border:0; border-top: 1px solid #CCC;}
            h4{margin: 0;}
            table{
                margin: 10px 0;
                width:100%;
                max-width:600px;
                border: 1px solid #CCC;
                border-spacing: 0;
            }
            table tr td, table tr th{
                padding: 5px 6px;
                font-size: 12px;
                font-weight: normal;
                border: 1px solid #CCC;
            }
            .border-none{
                border: none
            }
            .border-dotted{
                border:none;
                border-top: 2px dashed black;
            }
            .bg-primary{
                background: #b5d8fc;
            }
            .bg-dark{
                background: #000;
            }
            .bg-gray{
                background: #ccc;
            }
            .table-active{
                background-color: #CCC;
            }
            .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
            .vertical-top{
                vertical-align: top;
            }
            .page-break-after{
                page-break-after: always;
            }

            .margin-break{
                margin-top:7rem;
            }
            .page-num::before{
                content: 'Página ' counter(page)
            }
            footer {
                position: fixed;
                bottom: 0;
                left: 0px;
                right: 0px;
                height: 30px;
                width: 100vw;
            }
            header{
                position: fixed;
                top: 0;
                left: 0px;
                right: 0px;
                height: 120px;
                width: 100vw;
            }
            .state{
                top: 50%;
                left: 50%;
                position: fixed;
                font-size: 4cm;
                color:#FF0000;
                opacity: 0.5;
                transform: translate(-50%,-50%);
                z-index: -10;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <footer>
            <table class="border-none">
                <tr ><td colspan="10" class="border-none"></td></tr>
                <tr>
                    <td colspan="10" class="border-none">
                        <p class="text-center fs-0 m-0">Dirección: {{ tenant()->direccion }} - teléfono: {{ tenant()->telefono }}</p>
                        <p class="text-center fs-0 m-0">Correo: {{ tenant()->correo }} - Sitio web: {{ tenant()->pagina }}</p>
                    </td>
                </tr>
                <tr >
                    <td class= "border-none">
                        <p class="fs-s-1 text-start">Fecha y hora elaboración: {{ $facturaPredial->created_at->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-s-1 text-center">Fecha y hora impresión: {{ now()->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none" colspan="8">
                        <p class="fs-s-1 text-center">Dirección IP: {{ $facturaPredial->ip }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-s-1 text-right page-num"></p>
                    </td>
                </tr>
            </table>
        </footer>
        @if(!$facturaPredial->state)
        <div class="state">anulado</div>
        @endif
        <main>
            @for ( $i = 0;  $i < $tablas ;  $i++)
            <div>
                <table>
                    <tr>
                        <td rowspan="2" class="w33">
                            <div style="display: block; margin-left: auto; margin-right: auto; font-size: 16px; text-align: center;">
                                <img src="data:image/png;base64,{{ tenant()->imagen }}"  height="60" width="60"alt="">
                            </div>
                        </td>
                        <td rowspan="2" class="w33 text-center">
                            <p class="fs-2">{{ tenant()->nombre }}</p>
                            <p>NIT: {{ tenant()->nit }}</p>
                            <p>{{ tenant()->entidad }}</p>
                        </td>
                        <td class="bg-primary w-33 fs-2 fw-bold text-center">No. de liquidación</td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ $facturaPredial->id }}</td>
                    </tr>
                </table>
                <table class="border-none">
                    <tr>
                        <td colspan="10" class="border-none bg-primary fw-bold text-center fs-3">Recibo de cobro impuesto predial unificado</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td colspan="3" >
                            <p class="fs-1 vertical-top fw-bold">Referencia Catastral</p>
                            <p class="fs-1">{{ $facturaPredial->data['codigo_catastro']}}</p>
                        </td>
                        <td colspan="3" >
                            <p class="fs-1 vertical-top fw-bold">Dirección</p>
                            <p class="fs-1">{{ $facturaPredial->data['direccion']}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="fs-1 vertical-top fw-bold">Nombres y apellidos</p>
                            <p class="fs-1">{{ $facturaPredial->data['nombre_propietario']}}</p>
                        </td>
                        <td colspan="2">
                            <p class="fs-1 vertical-top fw-bold">Identificación</p>
                            <p class="fs-1">{{ $facturaPredial->data['documento']}}</p>
                        </td>
                        <td>
                            <p class="fs-1 vertical-top fw-bold fw-bold">Área del terreno </p>
                            <p class="fs-1">{{ $facturaPredial->data['hectareas']}} Ha - {{ $facturaPredial->data['metros_cuadrados']}} m2</p>
                        </td>
                        <td colspan="2">
                            <p class="fs-1 vertical-top fw-bold">Área construida</p>
                            <p class="fs-1">{{ $facturaPredial->data['area_construida']}} m2</p>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="border-none">
                <tr class="bg-primary  p-1">
                    <th class="fs-0">Vigencia</th>
                    <th class="fs-0">Avaluo</th>
                    <th class="fs-0">Tasa x Mil</th>
                    <th class="fs-0">Predial</th>
                    <th class="fs-0">Intereses Predial</th>
                    <th class="fs-0">Descuento intereses</th>
                    <th class="fs-0">Total intereses predial</th>
                    <th class="fs-0">Sobretasa bomberil</th>
                    <th class="fs-0">Sobretasa ambiental</th>
                    <th class="fs-0">Sobretasa intereses</th>
                    <th class="fs-0">Alumbrado</th>
                    <th class="fs-0">Total</th>
                </tr>
                <tbody>
                    @for ( $j =  $index;  $j < $longitud ;  $j++)
                        @php
                            $total +=$periodosFacturados[$j]['total_liquidacion'];
                        @endphp
                        @if ($j > $limite)
                            @php
                            $index += $constante;
                            $limite +=$constante;
                            @endphp
                            @break
                        @endif
                        <tr>
                            <td class="fs-s-1">{{ $periodosFacturados[$j]['vigencia'] }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['valor_avaluo'],0,',','.')}} </td>
                            <td class="fs-s-1">{{ $periodosFacturados[$j]['tasa_por_mil'] }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['predial'],0,',','.')}} </td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['predial_intereses'],0,',','.') }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['total_intereses'],0,',','.') }}  </td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['descuento_intereses'],0,',','.') }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['bomberil'],0,',','.') }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['ambiental'],0,',','.') }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['bomberil_intereses']+$periodosFacturados[$j]['ambiental_intereses'],0,',','.') }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['alumbrado'],0,',','.') }}</td>
                            <td class="fs-s-1" style="white-space: nowrap;">${{ number_format($periodosFacturados[$j]['total_liquidacion'],0,',','.') }}</td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="6" class="border-none"></td>
                        <td colspan="2" class="fs-2 bg-primary fw-bold">
                            Pague hasta
                        </td>
                        <td colspan="2" class="text-center">
                            <p class="fs-0 vertical-top fw-bold">Fecha</p>
                            <p class="fs-0">{{ (new \Illuminate\Support\Carbon($facturaPredial->data['pague_hasta']))->format('d/m/Y') }}</p>
                        </td>
                        <td colspan="2" class="text-right">
                            <p class="fs-0 vertical-top fw-bold">Valor</p>
                            <p class="fs-0">${{ number_format($total,0,',','.') }}</p>
                        </td>
                    </tr>
                    <tr><td class="border-none" colspan="12"></td></tr>
                </tbody>
            </table>
            @if ($i+1 != $tablas)
                <div style="page-break-after: always;"></div>
            @endif
            @endfor
            <table class="border-none" >
                <tr>
                    <td class="border-none text-center fs-0"  colspan="10">
                        Contra la presente liquidacion procede el recurso de reconsideracion dentro de los dos (2) meses siguientes a su notificacion
                    </td>
                </tr>
                <tr><td class="border-none text-center fw-bold fs-0" colspan="10">Copia contribuyente</td></tr>
                <tr><td class="border-dotted" colspan="10"></td></tr>
                <tr>
                    <td colspan="10" class="border-none text-center">
                        <p class="fs-0">{{ tenant()->nombre }}</p>
                        <p class="fs-0">{{ tenant()->entidad }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <p class="fs-0 vertical-top fw-bold">Referencia Catastral</p>
                        <p class="fs-0">{{ $facturaPredial->data['codigo_catastro'] }}</p>
                    </td>
                    <td colspan="3">
                        <p class="fs-0 vertical-top fw-bold">Periodo facturado</p>
                        <p class="fs-0">{{ $periodoFacturado }}</p>
                    </td>
                    <td colspan="3">
                        <p class="fs-0 vertical-top fw-bold">No liquidación</p>
                        <p class="fs-0">{{ $facturaPredial->id }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="border-none text-center"><img src="data:image/png;base64,{{ $facturaPredial->data['barcode'] }}" height="30" alt="barcode" /></td>
                </tr>
                <tr>
                    <td colspan="10" class="border-none text-center">
                        <p class="fs-s-1">(415)7709998105867(8020)010001178011100501(3900)0000469514(96)20231031</p>
                        <p class="fs-s-1">
                            Señor Cajero: Por favor no colocar el sello en el código de barras
                        </p>
                    </td>
                </tr>
                <tr><td class="border-none text-center fw-bold fs-0" colspan="10">Copia banco</td></tr>
                <tr><td class="border-dotted" colspan="10"></td></tr>
                <tr>
                    <td colspan="10" class="border-none text-center">
                        <p class="fs-0">{{ tenant()->nombre }}</p>
                        <p class="fs-0">{{ tenant()->entidad }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" >
                        <p class="fs-0 vertical-top fw-bold">Referencia Catastral</p>
                        <p class="fs-0">{{ $facturaPredial->data['codigo_catastro'] }}</p>
                    </td>
                    <td colspan="3">
                        <p class="fs-0 vertical-top fw-bold">Periodo facturado</p>
                        <p class="fs-0">{{ $periodoFacturado }}</p>
                    </td>
                    <td colspan="3">
                        <p class="fs-0 vertical-top fw-bold">No liquidación</p>
                        <p class="fs-0">{{ $facturaPredial->id }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="border-none text-center"><img src="data:image/png;base64,{{ $facturaPredial->data['barcode'] }}" height="30" alt="barcode" /></td>
                </tr>
                <tr>
                    <td colspan="10" class="border-none text-center">
                        <p class="fs-s-1">(415)7709998105867(8020)010001178011100501(3900)0000469514(96)20231031</p>
                        <p class="fs-s-1">
                            Señor Cajero: Por favor no colocar el sello en el código de barras
                        </p>
                    </td>
                </tr>
            </table>
        </main>

    </body>
</html>
