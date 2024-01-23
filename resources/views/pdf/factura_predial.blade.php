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
            footer {
                position: fixed;
                bottom: 0;
                left: 0px;
                right: 0px;
                height: 60px;
                width:100vw;
            }
        </style>
    </head>
    <body>
        <header>
            <table>
                <tr>
                    <td rowspan="2" class="w33">
                        <div style="display: block; margin-left: auto; margin-right: auto; font-size: 16px; text-align: center;">
                            <img src="data:image/png;base64,{{ tenant()->imagen }}"  height="100" width="100"alt="">
                        </div>
                    </td>
                    <td rowspan="2" class="w33 text-center">
                        <p class="fs-3">{{ tenant()->nombre }}</p>
                        <p>NIT: {{ tenant()->nit }}</p>
                        <p>{{ tenant()->entidad }}</p>
                    </td>
                    <td class="bg-primary w-33 fs-3 fw-bold text-center">No. de liquidación</td>
                </tr>
                <tr>
                    <td class="text-center">{{ $facturaPredial->id }}</td>
                </tr>
            </table>
        </header>
        <main>
            <table class="border-none">
                <tr>
                    <td colspan="10" class="border-none bg-primary fw-bold text-center fs-3">Recibo de cobro impuesto predial unificado</td>
                </tr>
                <tr><td class="border-none" colspan="10"></td></tr>
            </table>
            <table>
                <tr>
                    <td colspan="3" >
                        <p class="fs-1 vertical-top fw-bold">Referencia Catastral</p>
                        <p>{{ $facturaPredial->data['codigo_catastro']}}</p>
                    </td>
                    <td colspan="3" >
                        <p class="fs-1 vertical-top fw-bold">Dirección</p>
                        <p>{{ $facturaPredial->data['direccion']}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="fs-1 vertical-top fw-bold">Nombres y apellidos</p>
                        <p>{{ $facturaPredial->data['nombre_propietario']}}</p>
                    </td>
                    <td colspan="2">
                        <p class="fs-1 vertical-top fw-bold">Identificación</p>
                        <p>{{ $facturaPredial->data['documento']}}</p>
                    </td>
                    <td>
                        <p class="fs-1 vertical-top fw-bold fw-bold">Área del terreno </p>
                        <p>{{ $facturaPredial->data['hectareas']}} Ha - {{ $facturaPredial->data['metros_cuadrados']}} m2</p>
                    </td>
                    <td colspan="2">
                        <p class="fs-1 vertical-top fw-bold">Área construida</p>
                        <p>{{ $facturaPredial->data['area_construida']}} m2</p>
                    </td>
                </tr>
            </table>
            <table class="border-none">
                <tr><td class="border-none" colspan="10"></td></tr>
            </table>
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
                    @php
                        $total=0;
                    @endphp
                    @foreach ($facturaPredial->data['liquidacion']['vigencias'] as $vigencia)
                        @if ($vigencia['isSelected'])
                        @php
                            $total +=$vigencia['total_liquidacion'];
                        @endphp
                        <tr>
                            <td class="fs-0">{{ $vigencia['vigencia'] }}</td>
                            <td class="fs-0">${{ number_format($vigencia['valor_avaluo'],0,',','.')}} </td>
                            <td class="fs-0">{{ $vigencia['tasa_por_mil'] }}</td>
                            <td class="fs-0">${{ number_format($vigencia['predial'],0,',','.')}} </td>
                            <td class="fs-0">${{ number_format($vigencia['predial_intereses'],0,',','.') }}</td>
                            <td class="fs-0">${{ number_format($vigencia['total_intereses'],0,',','.') }}  </td>
                            <td class="fs-0">${{ number_format($vigencia['descuento_intereses'],0,',','.') }}</td>
                            <td class="fs-0">${{ number_format($vigencia['bomberil'],0,',','.') }}</td>
                            <td class="fs-0">${{ number_format($vigencia['ambiental'],0,',','.') }}</td>
                            <td class="fs-0">${{ number_format($vigencia['bomberil_intereses']+$vigencia['ambiental_intereses'],0,',','.') }}</td>
                            <td class="fs-0">${{ number_format($vigencia['alumbrado'],0,',','.') }}</td>
                            <td class="fs-0">${{ number_format($vigencia['total_liquidacion'],0,',','.') }}</td>
                        </tr>
                        @endif
                    @endforeach
                    <tr ><td colspan="10" class="border-none"></td></tr>
                    <tr>
                        <td colspan="5" class="border-none"></td>
                        <td colspan="2" class="fs-2 bg-primary fw-bold">
                            Pague hasta
                        </td>
                        <td colspan="2" class="text-center">
                            <p class="fs-1 vertical-top fw-bold">Fecha</p>
                            <p>31/10/2023</p>
                        </td>
                        <td colspan="2" class="text-right">
                            <p class="fs-1 vertical-top fw-bold">Valor</p>
                            <p>{{ number_format($total,0,',','.') }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="border-none">
                <tr><td class="border-none" colspan="10"></td></tr>
                <tr>
                    <td class="border-none text-center " colspan="10">
                        Contra la presente liquidacion procede el recurso de reconsideracion dentro de los dos (2) meses siguientes a su notificacion
                    </td>
                </tr>
                <tr><td class="border-none text-center fw-bold fs-1" colspan="10">Copia contribuyente</td></tr>
                <tr><td class="border-dotted" colspan="10"></td></tr>
                <tr>
                    <td colspan="10" class="border-none text-center">
                        <p class="fs-1">{{ tenant()->nombre }}</p>
                        <p class="fs-0">{{ tenant()->entidad }}</p>
                    </td>
                </tr>
            </table>
            <table class="border-none">
                <tr>
                    <td >
                        <p class="fs-1 vertical-top fw-bold">Referencia Catastral</p>
                        <p>{{ $facturaPredial->data['codigo_catastro'] }}</p>
                    </td>
                    <td colspan="3">
                        <p class="fs-1 vertical-top fw-bold">Periodo facturado</p>
                        <p>2013-2023</p>
                    </td>
                    <td colspan="2">
                        <p class="fs-1 vertical-top fw-bold">No liquidación</p>
                        <p>{{ $facturaPredial->id }}</p>
                    </td>
                </tr>
                <tr >
                    <td  class="border-none"></td>
                </tr>
                <tr>
                    <td colspan="6" class="border-none text-center"><img src="data:image/png;base64,{{ $facturaPredial->data['barcode'] }}" height="40" alt="barcode" /></td>
                </tr>
                <tr>
                    <td colspan="6" class="border-none text-center">
                        <p class="fs-0">(415)7709998105867(8020)010001178011100501(3900)0000469514(96)20231031</p>
                        <p class="fs-0">
                            Señor Cajero: Por favor no colocar el sello en el código de barras
                        </p>
                    </td>
                </tr>

            </table>
            <table class="border-none">
                <tr><td class="border-none" colspan="10"></td></tr>
                <tr><td class="border-none text-center fw-bold fs-1" colspan="10">Copia banco</td></tr>
                <tr><td class="border-dotted" colspan="10"></td></tr>
                <tr>
                    <td colspan="10" class="border-none text-center">
                        <p class="fs-1">{{ tenant()->nombre }}</p>
                        <p class="fs-0">{{ tenant()->entidad }}</p>
                    </td>
                </tr>
            </table>
            <table class="border-none">
                <tr>
                    <td >
                        <p class="fs-1 vertical-top fw-bold">Referencia Catastral</p>
                        <p>{{ $facturaPredial->data['codigo_catastro'] }}</p>
                    </td>
                    <td colspan="3">
                        <p class="fs-1 vertical-top fw-bold">Periodo facturado</p>
                        <p>2013-2023</p>
                    </td>
                    <td colspan="2">
                        <p class="fs-1 vertical-top fw-bold">No liquidación</p>
                        <p>{{ $facturaPredial->id }}</p>
                    </td>
                </tr>
                <tr >
                    <td  class="border-none"></td>
                </tr>
                <tr>
                    <td colspan="6" class="border-none text-center"><img src="data:image/png;base64,{{ $facturaPredial->data['barcode'] }}" height="40" alt="barcode" /></td>
                </tr>
                <tr>
                    <td colspan="6" class="border-none text-center">
                        <p class="fs-0">(415)7709998105867(8020)010001178011100501(3900)0000469514(96)20231031</p>
                        <p class="fs-0">
                            Señor Cajero: Por favor no colocar el sello en el código de barras
                        </p>
                    </td>
                </tr>

            </table>
        </main>
        <footer>
            <table class="border-none">
                <tr ><td colspan="10" class="border-none"></td></tr>
                <tr>
                    <td colspan="10" class="border-none">
                        <p class="text-center fs-0">Dirección: {{ tenant()->direccion }} - teléfono: {{ tenant()->telefono }}</p>
                        <p class="text-center fs-0">Correo: {{ tenant()->correo }} - Sitio web: {{ tenant()->pagina }}</p>
                    </td>
                </tr>
                <tr >
                    <td class= "border-none">
                        <p class="fs-0 text-start">Fecha y hora elaboración: {{ $facturaPredial->created_at->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-0 text-center">Fecha y hora impresión: {{ now()->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none" colspan="8">
                        <p class="fs-0 text-right">Dirección IP: {{ $facturaPredial->ip }}</p>
                    </td>
                </tr>
            </table>
        </footer>
    </body>
</html>
