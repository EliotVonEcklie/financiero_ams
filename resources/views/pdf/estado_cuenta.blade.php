@php
    function showCharacters($string, $end = 2){
        $getchars = Str::substr($string, 0, $end);
        $newString = implode("",explode(" ",$string));
        $arrString = mb_str_split($newString);
        $result = "";
        for ($i=0; $i < count($arrString) ; $i++) {
            $arrString[$i] = $i >= $end ? "*" : $arrString[$i];
        }

        $result = implode($arrString);
        return $result;
    }
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
                    <td class="bg-primary w-33 fs-3 fw-bold text-center">No. Estado de cuenta</td>
                </tr>
                <tr>
                    <td class="text-center">{{ $estadoCuenta->id }}</td>
                </tr>
            </table>
        </header>
        <main>
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
                        <p>Habitacional</p>
                    </td>
                </tr>
            </table>
            <table class="border-none">
                <tr>
                    <td colspan="10" class="border-none bg-primary fw-bold text-center fs-3">Estado financiero</td>
                </tr>
                <tr><td class="border-none" colspan="10"></td></tr>
            </table>
            <table>
                <tr class="bg-primary  p-1">
                    <th class="fs-0">Vigencia</th>
                    <th class="fs-0">Predial</th>
                    <th class="fs-0">Tasa x Mil</th>
                    <th class="fs-0">Intereses Predial</th>
                    <th class="fs-0">Descuento intereses</th>
                    <th class="fs-0">Total intereses predial</th>
                    <th class="fs-0">Sobretasa bomberil</th>
                    <th class="fs-0">Sobretasa ambiental</th>
                    <th class="fs-0">Sobretasa intereses</th>
                    <th class="fs-0">Alumbrado</th>
                    <th class="fs-0">Descuentos</th>
                    <th class="fs-0">Total</th>
                </tr>
                <tbody>
                    @foreach ($estadoCuenta->data['vigencias'] as $vigencia)
                        <tr>
                            <td class="fs-1">{{ $vigencia['vigencia'] }}</td>
                            <td class="fs-1">${{ number_format($vigencia['valor_predial'],0,',','.')}} </td>
                            <td class="fs-1">{{ $vigencia['tasa_por_mil'] }}</td>
                            <td class="fs-1">${{ number_format($vigencia['predial_intereses'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['total_intereses'],0,',','.') }}  </td>
                            <td class="fs-1">${{ number_format($vigencia['descuento_intereses'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['bomberil'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['ambiental'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['bomberil_intereses']+$vigencia['ambiental_intereses'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['alumbrado'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['total_descuentos'],0,',','.') }}</td>
                            <td class="fs-1">${{ number_format($vigencia['total'],0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
                <tr class="bg-primary  p-1">
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
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['predial'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['bomberil'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['ambiental'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['alumbrado'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['intereses'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['descuentos'], 0, ',', '.') }}</td>
                        <td class="fs-0">${{ number_format($estadoCuenta->data['totales']['total'], 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer>
            <table class="border-none">
                <tr ><td colspan="10" class="border-none"></td></tr>
                <tr>
                    <td class="border-none">
                        <p class="text-center">
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
                        <p class="fs-0 text-start">Fecha y hora elaboración: {{ $estadoCuenta->created_at->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none">
                        <p class="fs-0 text-center">Fecha y hora impresión: {{ now()->format('Y-m-d H:i:s') }}</p>
                    </td>
                    <td class="border-none" colspan="8">
                        <p class="fs-0 text-right">Dirección IP: {{ $estadoCuenta->ip }}</p>
                    </td>
                </tr>
            </table>
        </footer>
    </body>
</html>
