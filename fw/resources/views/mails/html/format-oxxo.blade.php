<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <div style="min-width: 300px; max-width: 600px; margin: auto; text-align: center;font-family: Tahoma, Geneva, sans-serif; background: #f9f9f9;">
            <div style="padding: 2%; text-align: left; background: #FFF; box-shadow: 0 1px 3px #ddd;">
                <img src="{{asset('/css/logo-bounce.svg')}}" />
            </div>
            <div style="padding: 10px 60px 10px 60px;">
                <p style="font-size: 20px; color: #1893D7;">¡Gracias por elegirnos!</p>
                <div>
                    <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top;">
                        No. Orden <b>{{$order->id}}</b>
                    </div>
                    <div style="width: 49%; text-align: right; display: inline-block; vertical-align: top;">
                        Fecha de emisión: <b>{{$order->getDateTiemeCreateAt()->format('Y/m/d')}}</b>
                    </div>
                </div>
                <p style="text-align: left;">

                <div style="border-top: solid 3px #8DC63F; padding-top: 10px; text-align:justify;">                 
                    Enhorabuena <b>"{{$order->user->name}}"</b> <br><br>

					Imprime el formato de pago adjunto en este correo, ve a la sucursal de OXXO más cercana a pagar y ¡listo!. <br><br>

					Eso es todo, nuestro sistema detecta el pago y procederá tu orden en automático. Éste proceso puede tardar hasta 24 hrs. <br><br>
                </div>
                <div style="border: solid 1px #CFE0EF; margin: 3px 0 0 0;">
                	<div style="border-top: solid 1px #CFE0EF;">
                        <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%; border-right: solid 1px #CFE0EF;">
                            <span style="">Pagar antes de </span>
                        </div>
                        <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                            {{$order->getStrDateOxxoExpireAt()}}
                        </div>
                    </div>
                    <div style="border-top: solid 1px #CFE0EF;">
                        <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%; border-right: solid 1px #CFE0EF;">
                            <span style="">Monto a pagar </span>
                        </div>
                        <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                            {{Helpers::formatCurrency($order->total)}}
                        </div>
                    </div>
                </div>
                <div style=" padding-top: 10px; text-align:justify;">                 
                    Cuando OXXO acredite tu pago recibirás la confirmación de tu orden, a partir de ese momento tu pedido se surte y es enviado al domicilio que estableciste. <br><br>

					El presente cupón esta adjunto en este correo en formato PDF y debe imprimirse de forma legible y clara, sin tachaduras y/o dobleces. De lo contrario, podrá suceder que la tienda tenga problemas al capturarlo. <br><br>

					El establecimiento cobrará una cuota de $8.00 por concepto de cobranza. <br><br>
                </div>

            </div>
            <div style="background: #002B53; padding: 10px;">
	            <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top; color: #FFF;">
	                <span style="display: block; padding: 10px 0 0 0;">
	                    Horario de atención: {{Config('app.schedule')}}<br />
	                    <a href="{{route('Content.slug',['slug'=>'aviso-de-privacidad'])}}" style="font-size: 12px; color: #FFF; text-decoration: none;">Aviso de privacidad</a>
	                </span>
	            </div>
	            <div style="width: 49%; text-align: right; display: inline-block; vertical-align: top;">
	                
	                <a href="{{Config('app.social.facebook')}}" target="_blank"><img src="{{asset('img/mail/02icono.jpg')}}"/></a>

	                <a href="{{Config('app.social.instagram')}}" target="_blank"><img src="{{asset('img/mail/04icono.jpg')}}"/></a>
	            </div>
	        </div>
        </div>
    </body>
</html>