@php

use \Illuminate\Support\Carbon;

$created_at = new Carbon($pazYSalvo->created_at);
$hasta = new Carbon($pazYSalvo->data['hasta']);

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
            .uppercase{
                text-transform: uppercase;
            }
            .border-bottom{
                border-bottom: #000 solid 2px
            }
        </style>
    </head>
    <body>
        <header>
            <table>
                <tr>
                    <td rowspan="4" class="w33">
                        <div style="display: block; margin-left: auto; margin-right: auto; font-size: 16px; text-align: center;">
                            <img src="data:image/png;base64,{{ tenant()->imagen }}"  height="120" width="120" alt="Escudo del municipio">
                        </div>
                    </td>
                    <td rowspan="2" class="w33 text-center">
                        <p class="fs-2">{{ tenant()->nombre }}</p>
                        <p>NIT: {{ tenant()->id }}</p>
                        <p>{{ tenant()->entidad }}</p>
                    </td>
                    <td class="bg-primary w-33 fs-2 fw-bold text-center">No. Consecutivo</td>
                </tr>
                <tr>
                    <td class="text-center">{{ $pazYSalvo->id }}</td>
                </tr>
                <tr>
                    <td class="bg-primary w-33 fs-2 fw-bold text-center">Paz y Salvo</td>

                    <td class="bg-primary w-33 fs-2 fw-bold text-center">Fecha de expedición</td>
                </tr>
                <tr>
                    <td class="text-center">
                        <p class="fw-bold"> Código catastral</p>
                        <p>{{ $pazYSalvo->data['codigo_catastro'] }}</p>
                    </td>
                    <td class="text-center">{{ $created_at->format('d/m/Y') }}</td>
                </tr>
            </table>
        </header>
        <footer>
            <table class="border-none">
                <tr ><td colspan="10" class="border-none"></td></tr>
                <tr>
                    <td colspan="10" class="border-none">
                        <p class="text-center fs-0 m-0">Dirección: {{ tenant()->direccion }}</p>
                        <p class="text-center fs-0 m-0">Correo: {{ tenant()->correo }}</p>
                    </td>
                </tr>
                <tr >
                    <td class= "border-none">
                        <p class="fs-0 text-start">Fecha y hora elaboración: {{ $pazYSalvo->created_at }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-0 text-center">Fecha y hora impresión: {{ now() }}</p>
                    </td>
                    <td class="border-none" colspan="8">
                        <p class="fs-0 text-center">Dirección IP: {{ $pazYSalvo->ip }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-0 text-right page-num"></p>
                    </td>
                </tr>
            </table>
        </footer>
        <main style="margin-top:5cm">
            <table class="border-none">
                <tr>
                    <td class="border-none text-center">
                        <h2>
                            LA {{ strtoupper(tenant()->entidad) }} DEL<br>
                            {{ strtoupper(tenant()->nombre) }} - {{ strtoupper(tenant()->departamento ?? 'meta') }} CERTIFICA
                        </h2>
                    </td>
                </tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr>
                    <td class="border-none">
                        <p class="fs-2" style="text-align: justify; text-align-last: justify;">
                            Que, el predio identificado con numero de cedula catastral
                            {{ $pazYSalvo->data['codigo_catastro'] }}, inscrito en el listado de catastro para este
                            municipio, a nombre de {{ $pazYSalvo->data['nombre_propietario'] }} con numero
                            de documento {{ $pazYSalvo->data['documento'] }}
                            @if (count($pazYSalvo->data['propietarios']) > 0) y OTROS @endif
                            Denominado
                            {{ $pazYSalvo->data['direccion'] }} con una Extension de {{ $pazYSalvo->data['hectareas'] }}
                            Hectareas, {{ $pazYSalvo->data['metros_cuadrados'] }} Metros y
                            {{ $pazYSalvo->data['area_construida'] }} AC. Avaluo de
                            ${{ number_format($pazYSalvo->data['valor_avaluo'], 0, '.') }} Se halla a PAZ Y SALVO con el
                            Tesoro Municipal, Por concepto de IMPUESTO PREDIAL hasta el
                            {{ NumberFormatter::create('es', NumberFormatter::SPELLOUT)->format($hasta->day) }}
                            {{ $hasta->locale('es')->isoFormat('(D) \d\e MMMM \d\e YYYY') }}. no se genera cobro por
                            valorizacion para la vigencia actual ni vigencias anteriores.
                        </p>
                    </td>
                </tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr>
                    <td class="border-none fs-2" style="text-align: justify; text-align-last: justify;">
                        @if (count($pazYSalvo->data['propietarios']) > 0)
                            @php
                                $propietarios = array_merge([[
                                    'nombre_propietario' => $pazYSalvo->data['nombre_propietario'],
                                    'documento' => $pazYSalvo->data['documento']
                                ]], $pazYSalvo->data['propietarios'])
                            @endphp

                            NOTA: El predio No. {{ $pazYSalvo->data['codigo_catastro'] }} tiene {{ count($pazYSalvo->data['propietarios']) }} propietarios:

                            {{ implode(', ', array_map(fn ($p) => $p['nombre_propietario'] . ' con numero de documento ' . $p['documento'], $propietarios)) }}.
                        @endif
                    </td>
                </tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr>
                    <td class="border-none fs-2">
                        @isset($pazYSalvo->data['concepto'])
                            Valido para: {{ $pazYSalvo->data['concepto'] }}
                        @endisset
                    </td>
                </tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr>
                    <td class="border-none fs-2">Se Expide, a los {{ $created_at->locale('es')->isoFormat('D \d\i\a\s \d\e\l \m\e\s \d\e MMMM \d\e YYYY') }}.</td>
                </tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
                <tr><td class="border-none"></td></tr>
            </table>
            <table class="border-none">
                <tr>
                    <td class="border-none"></td>
                    <td class="border-none text-center fs-2" colspan="2"></td>
                    <td class="border-none"></td>
                </tr>
                <tr>
                    <td class="border-none"></td>
                    <td colspan="2" class="border-none border-bottom"></td>
                    <td class="border-none"></td>
                </tr>
                <tr>
                    <td class="border-none"></td>
                    <td class="border-none text-center fw-bold fs-2" colspan="2">
                        <p>{{ strtoupper($pazYSalvo->data['firma']->funcionario) }}</p>
                        <p>{{ strtoupper($pazYSalvo->data['firma']->titulo) }}</p>
                    </td>
                    <td class="border-none"></td>
                </tr>
                <tr>
                    <td class="border-none"></td>
                    <td colspan="2" class="border-none"></td>
                    <td class="border-none"></td>
                </tr>
                <tr>
                    <td class="border-none"></td>
                    <td class="border-none text-left fw-bold fs-2" colspan="2">
                        <p>Proyectó: {{ strtoupper($pazYSalvo->user->name) }}</p>
                    </td>
                    <td class="border-none"></td>
                </tr>
            </table>
        </main>
    </body>
</html>
