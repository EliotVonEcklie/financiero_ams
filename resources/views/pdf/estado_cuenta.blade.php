<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            p{
                font-family: arial;
                letter-spacing: 1px;
                font-size: 12px;
                margin:0;
            }
            .t-1{
                color:#E05A10;
            }
            .t-2{
                color:#03071E;
            }
            .t-3{
                color:#6D6A75;
            }
            .t-4{
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
            .w15{
                width:15%;
            }
            .w100{
                width:100%;
            }
            hr{border:0; border-top: 1px solid #CCC;}
            h4{font-family: arial; margin: 0;}
            table{
                margin: 10px 0;
                width:100%;
                max-width:600px;
                border: 1px solid #CCC;
                border-spacing: 0;
            }
            table tr td, table tr th{
                padding: 5px 10px;
                font-family: arial;
                font-size: 12px;
            }
            #detalleOrden tr td{
                border: 1px solid #CCC;
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
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td class="w33">
                    logo
                </td>
                <td class="w33 text-center">

                </td>
                <td class=" w33 text-right">
                    <p>

                    </p>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>Nombre:</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>CC/NIT:</td>
                <td>Nombre ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Teléfono</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td><strong>Notas:</strong></td>
                <td>Nombre</td>
            </tr>
        </table>
        <table>
            <thead class="table-active">
            <tr>
                <th>Referencia</th>
                <th>Descripción</th>
                <th class="text-right">Precio</th>
                <th class="text-right">Cantidad</th>
                <th class="text-right">Total</th>
            </tr>
            </thead>
            <tbody id="detalleOrden">

                <tr>
                    <td class="text-start w10">Referencia</td>

                    <td class="text-start w55">Descripción</td>
                    <td class="text-start w55">Descripción</td>
                    <td class="text-start w55">Descripción</td>
                    <td class="text-start w55">Descripción</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Subtotal:</th>
                    <td class="text-right">1000</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Cupon:</th>
                    <td class="text-right">1000</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Subtotal:</th>
                    <td class="text-right">1000</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Envio:</th>
                    <td class="text-right">1000</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Total:</th>
                    <td class="text-right">1000</td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>

