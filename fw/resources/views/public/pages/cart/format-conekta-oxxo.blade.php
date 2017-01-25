<?php
$pm = $order->getInfoPsp()->payment_method;
$couta = \DwSetpoint\Models\DBConfig::getCoutaOxxo();
extract(get_object_vars($pm));
?><html>
    <head>
        <style>
           
            body, table {
                /*font-size: 12pt;
                font-family: Arial;
                color: #7F8082;*/
             
            }
            td .label {
                font-weight: bold;
            }
            h1 {
                color:green;
                font-size: 16px;
            }
            .info{
                background-image: url({{asset('img/mail/oxxo_v1/forma-pago_div-pago.png')}});
                background-repeat: no-repeat;
                display: block;
                width: 585px;
                height: 200px;
                margin: 0 auto;
            }
            .info table{
                padding: 25px 35px;
                
            }
            .label{
                width: 120px;
            }
        </style>
    </head>
    <body>
        <table style="width: 100% margin: auto; padding: 20px 0 0 0; font-family: Tahoma, Geneva, sans-serif; background: #f9f9f9;"">
            <tr>
                <td><img src="{{asset('img/mail/oxxo_v1/bounce.png')}}"></td> 
                <td><img src="{{asset('img/mail/oxxo_v1/conekta.jpg')}}"></td>
            </tr>
            <tr> 
                <td colspan="2">
                    <div style="border-top: solid 3px #8DC63F;">
                    <p style="font-size: 20px; color: #1893D7; text-align: center;">Forma de pago</p>
                    <p>En horabuena "{{$order->user->name}}"</p>
                    <p>Imprime esta forma de pago, ve a la sucursal de Oxxo más cercana a pagar y ¡listo!.</p>
                    <p>Eso es todo, nuestro sistema detecta el pago y procederá tu orden en automático (Éste proceso puede tardar hasta 24 hrs)</p>
                    <div class="info">
                        <table>
                        <tr style="border: solid 1px #CFE0EF; margin: 3px 0 0 0;">
                            <td class="label">Nombre:     </td>
                            <td>{{$order->user->name}}</td>
                        </tr>
                        <tr>
                            <td class="label">Fecha de emisión:     </td>
                            <td class="value">{{$order->getStringDateCreateAt()}}</td>
                        </tr>
                        <tr>
                            <td class="label">Orden:     </td>
                            <td class="value">{{$order->id}}</td>
                        </tr>
                        <tr>
                            <td class="label">Pagar antes del:     </td>
                            <td class="value">{{$order->getStrDateOxxoExpireAt()}}</td>
                        </tr>
                        <tr>
                            <td class="label">Monto a pagar:     </td>
                            <td class="value">{{Helpers::formatCurrency($order->total)}}</td>
                        </tr>
                    </table>
                    </div>
                    
                    <p>Al instante en que Oxxo nos acredita tu pago recibirás la confirmación de tu orden, a partir de ese momento tu pedido se surte y es enviado al domiciolio que estableciste.</p>
                </td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: center"><img src="{{asset('img/oxxo.png')}}"></td>
                <td style="text-align: center">
                    <img src="{{$barcode_url}}">
                    <div style="margin-top: 5px">{{$barcode}}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>El presente cupón debe imprimirse de forma legibley clara, preferentemente con impresora láser y conservase en buen estado sin tachaduras y/o dobleces. De lo contrario, puede que la tienda no pueda capturarlo.</p>
                    <p>El establecimiento cobrará una cuota de {{Helpers::formatCurrency($couta)}} por concepto de cobranza</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background: #002B53; padding: 10px;">
                    <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top; color: #FFF;">
                        <p>Contáctanos a: <br>
                        hola@bounce.com.mx <br>
                        (33) 3336 7487</p>
                    </div>
                    <div style="width: 49%; text-align: right; display: inline-block; vertical-align: top; color: #FFF;">
                        <p>Horario de atención:<br>
                        9:00 a 20:00</p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>