@php
    $limite = 12;
    $constante = 12;
    $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,26,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48];
    $vigencias = $estadoCuenta->data['liquidacion']['vigencias'];
    $longitud = count($vigencias);
    $tablas = round($longitud/$limite) > 0 ? round($longitud/$limite) : 1;
    $index = 0;
@endphp
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            p {
                font-size: 9pt;
                margin: 0;
                margin-bottom: 5px;
                padding: 0;
            }
            .t-1 {
                color: #E05A10;
            }

            .t-2 {
                color: #03071E;
            }

            .t-3 {
                color: #6D6A75;
            }

            .text-white {
                color: #fff;
            }
            .w10 {
                width: 10%;
            }
            .w33 {
                width: 33.33%;
            }
            .w55 {
                width: 55%;
            }
            .w50 {
                width: 50%;
            }
            .w15 {
                width: 15%;
            }
            .w100 {
                width: 100%;
            }
            .fs-s-1 {
                font-size: 6pt
            }
            .fs-0 {
                font-size: 7.2pt
            }
            .fs-1 {
                font-size:  8pt;
            }
            .fs-2 {
                font-size: 12pt;
            }
            .fs-3 {
                font-size: 14pt;
            }
            .fs-4 {
                font-size: 16pt;
            }
            .fs-5 {
                font-size: 20pt;
            }
            .fw-bold {
                font-weight: bold;
            }
            .fw-semibold {
                font-weight: 500;
            }
            .p-1 {
                padding: 5px 10px;
            }
            hr {
                border: 0;
                border-top: 1px solid #CCC;
            }
            h4 {
                margin: 0;
            }
            table {
                margin: 10px 0;
                width: 100%;
                max-width: 600px;
                border: 1px solid #CCC;
                border-spacing: 0;
            }
            table tr td, table tr th {
                padding: 5px 6px;
                font-size: 12px;
                font-weight: normal;
                border: 1px solid #CCC;
            }
            .border-none {
                border: none
            }
            .bg-primary {
                background: #b5d8fc;
            }
            .bg-dark {
                background: #000;
            }
            .bg-gray {
                background: #ccc;
            }
            .table-active {
                background-color: #CCC;
            }
            .text-center {
                text-align: center;
            }
            .text-right {
                text-align: right;
            }
            .vertical-top {
                vertical-align: top;
            }
            footer {
                position: fixed;
                bottom: 0;
                left: 0px;
                right: 0px;
                height: 120px;
                width: 100vw;
            }
            .page-num::before{
                content: 'Página ' counter(page)
            }
        </style>
    </head>
    <body>
        <footer>
            <table class="border-none">
                <tr ><td colspan="10" class="border-none"></td></tr>
                <tr>
                    <td class="border-none">
                        <p class="text-center fs-1">
                            Señor contribuyente: La Alcaldía Municipal del {{ tenant()->nombre }} META apoyado en la modernización y depuración de la
                            información existente, en caso de no ver algún pago que usted realizó, le solicitamos anexar los documentos correspondientes a
                            pagos de vigencias anteriores para actualización de su estado de cuenta.
                        </p>
                    </td>
                </tr>
            </table>
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
                        <p class="fs-s-1 text-start">Fecha y hora elaboración: {{ $estadoCuenta->created_at->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-s-1 text-center">Fecha y hora impresión: {{ now()->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none" colspan="8">
                        <p class="fs-s-1 text-center">Dirección IP: {{ $estadoCuenta->ip }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-s-1 text-right page-num"></p>
                    </td>
                </tr>
            </table>
        </footer>
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
                                <p class="fs-3">{{ tenant()->nombre }}</p>
                                <p>NIT: {{ tenant()->nit }}</p>
                                <p>{{ tenant()->entidad }}</p>
                            </td>
                            <td class="bg-primary w-33 fs-3 fw-bold text-center">No. Estado de cuenta</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ $estadoCuenta->id }}</td>
                        </tr>
                    </table>
                    <table class="border-none">
                        <tr>
                            <td colspan="10" class="border-none bg-primary fw-bold text-center fs-3">Estado de cuenta predial unificado</td>
                        </tr>
                        <tr><td class="border-none" colspan="10"></td></tr>
                    </table>
                    <table>
                        <tr class="bg-primary ">
                            <td colspan="6" class="fw-bold">A. INFORMACIÓN DEL PREDIO</td>
                        </tr>
                        <tr>
                            <td colspan="">
                                <p class="fs-1 vertical-top fw-bold">Referencia Catastral</p>
                                <p>{{ $estadoCuenta->data['codigo_catastro'] }}</p>
                            </td>
                            <td colspan="">
                                <p class="fs-1 vertical-top fw-bold">Total</p>
                                <p>{{ $estadoCuenta->data['total'] }}</p>
                            </td>
                            <td colspan="">
                                <p class="fs-1 vertical-top fw-bold">Orden</p>
                                <p>{{ $estadoCuenta->data['orden'] }}</p>
                            </td>
                            <td colspan="2">
                                <p class="fs-1 vertical-top fw-bold">Dirección del predio</p>
                                <p>{{ $estadoCuenta->data['direccion'] }}</p>
                            </td>
                            <td colspan="">
                                <p class="fs-1 vertical-top fw-bold">Avaluo vigente</p>
                                <p>${{ number_format($estadoCuenta->data['valor_avaluo'],0,',','.') }}</p>
                            </td>
                        </tr>
                        <tr class="bg-primary">
                            <td colspan="6" class="fw-bold">B. IDENTIFICACIÓN DEL SUJETO PASIVO DEL IMPUESTO PREDIAL UNIFICADO</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p class="fs-1 vertical-top fw-bold">Nombres y apellidos</p>
                                <p>{{ $estadoCuenta->data['nombre_propietario'] }}</p>
                            </td>
                            <td colspan="3">
                                <p class="fs-1 vertical-top fw-bold">Identificación</p>
                                <p>{{ $estadoCuenta->data['documento'] }}</p>
                            </td>
                        </tr>
                        <tr class="bg-primary">
                            <td colspan="3" class="fw-bold">C. INFORMACIÓN SOBRE ÁREA DEL PREDIO</td>
                            <td colspan="3" class="fw-bold">D. CLASIFICACIÓN DEL PREDIO</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="fs-1 vertical-top fw-bold fw-bold">Área del terreno </p>
                                <p>{{ $estadoCuenta->data['hectareas'] }} Ha - {{ $estadoCuenta->data['metros_cuadrados'] }} m2</p>
                            </td>
                            <td>
                                <p class="fs-1 vertical-top fw-bold">Área construida</p>
                                <p>{{ $estadoCuenta->data['area_construida'] }} m2</p>
                            </td>
                            <td>
                                <p class="fs-1 vertical-top fw-bold">Tipo de predio</p>
                                <p> {{ $estadoCuenta->data['predio_tipo'] }}</p>
                            </td>
                            <td colspan="2">
                                <p class="fs-1 vertical-top fw-bold">Destino socioeconómico</p>
                                <p>{{ $estadoCuenta->data['destino_economico'] }}</p>
                            </td>
                        </tr>
                    </table>
                    <table class="border-none">
                        <tr>
                            <td colspan="10" class="border-none bg-primary fw-bold text-center fs-3">Estado financiero</td>
                        </tr>
                        <tr><td class="border-none" colspan="10"></td></tr>
                    </table>
                </div>
                <table>
                    <tr class="bg-primary  p-1">
                        <th class="fs-s-1">Vigencia</th>
                        <th class="fs-s-1">Avaluo</th>
                        <th class="fs-s-1">Tasa x Mil</th>
                        <th class="fs-s-1">Predial</th>
                        <th class="fs-s-1">Intereses Predial</th>
                        <th class="fs-s-1">Descuento intereses</th>
                        <th class="fs-s-1">Total intereses predial</th>
                        <th class="fs-s-1">Sobretasa bomberil</th>
                        <th class="fs-s-1">Sobretasa ambiental</th>
                        <th class="fs-s-1">Sobretasa intereses</th>
                        <th class="fs-s-1">Alumbrado</th>
                        <th class="fs-s-1">Total</th>
                    </tr>
                    <tbody>
                        @for ( $j =  $index;  $j < $longitud ;  $j++)
                            @if ($j > $limite)
                                @php
                                    $index += $constante;
                                    $limite +=$constante
                                @endphp
                                @break
                            @endif
                            <tr>
                                <td class="fs-s-1">{{ $vigencias[$j]['vigencia'] }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['valor_avaluo'],0,',','.')}} </td>
                                <td class="fs-s-1">{{ $vigencias[$j]['tasa_por_mil'] }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['predial'],0,',','.')}} </td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['predial_intereses'],0,',','.') }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['total_intereses'],0,',','.') }}  </td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['descuento_intereses'],0,',','.') }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['bomberil'],0,',','.') }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['ambiental'],0,',','.') }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['bomberil_intereses']+$vigencias[$j]['ambiental_intereses'],0,',','.') }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['alumbrado'],0,',','.') }}</td>
                                <td class="fs-s-1">{{ number_format($vigencias[$j]['total_liquidacion'],0,',','.') }}</td>
                            </tr>
                        @endfor
                        <!--
                        @for ( $j =  $index;  $j < $longitud ;  $j++)
                            @if ($j > $limite)
                                @php
                                    $index += $constante;
                                    $limite +=$constante
                                @endphp
                                @break
                            @endif
                            <tr>
                                <td>{{ $arr[$j] }}</td>
                            </tr>
                        @endfor-->
                    </tbody>
                </table>
                @if ($i+1 != $tablas)
                <div style="page-break-after: always;"></div>
                @endif
            @endfor
            <table>
                <tr class="bg-primary  p-1">
                    <th class="fs-0 fw-bold">Total avaluo</th>
                    <th class="fs-0 fw-bold">Total predial</th>
                    <th class="fs-0 fw-bold">Total bomberil</th>
                    <th class="fs-0 fw-bold">Total ambiental</th>
                    <th class="fs-0 fw-bold">Total alumbrado</th>
                    <th class="fs-0 fw-bold">Total intereses</th>
                    <th class="fs-0 fw-bold">Total descuento</th>
                    <th class="fs-0 fw-bold">Total liquidacion</th>
                </tr>
                <tbody>
                    <tr>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['total_avaluo'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['predial'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['bomberil'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['ambiental'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['alumbrado'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['intereses'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['descuentos'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['liquidacion'], 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </main>

    </body>
</html>
