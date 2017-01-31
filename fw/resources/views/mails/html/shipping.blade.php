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
                        Fecha de compra: <b>{{$order->getDateTiemeCreateAt()->format('Y/m/d')}}</b>
                    </div>
                </div>
                <p style="text-align: left;">
                    <b style="color: #1893D7;">Tu pedido ha sido enviado</b>
                <div style="border-top: solid 3px #8DC63F; padding-top: 10px">                 
                    Puedes consultar tu pedido con el numero de guia <b>{{$order->guia}}</b> en: <a href="{!!$order->urlguia!!}" target="_blank">{{$order->urlguia}}</a>
                </div>
                <a href="{{route('user.getOrder',['order'=>$order->id])}}" style="background: #1893D7; color: #FFF; display: inline-block; padding: 8px 15px 8px 15px; text-decoration: none; margin: 20px 0 20px 0;">Consultar Pedido en Línea</a>
                </p>
            </div>
            <div style="background: #002B53; padding: 10px;">
                <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top; color: #FFF;">
                    <span style="display: block; padding: 10px 0 0 0;">
                        Horario de atención: 00:00 a 00:00<br />
                        <a href="" style="font-size: 12px; color: #FFF; text-decoration: none;">Aviso de privacidad</a>
                    </span>
                </div>
                <div style="width: 49%; text-align: right; display: inline-block; vertical-align: top;">
                    <a href="{{Config('app.social.twitter')}}" target="_blank"><img src="{{asset('img/mail/01icono.jpg')}}"/></a>
                    <a href="{{Config('app.social.facebook')}}" target="_blank"><img src="{{asset('img/mail/02icono.jpg')}}"/></a>
                    <a href="{{Config('app.social.youtube')}}" target="_blank"><img src="{{asset('img/mail/03icono.jpg')}}"/></a>
                    <a href="{{Config('app.social.instagram')}}" target="_blank"><img src="{{asset('img/mail/04icono.jpg')}}"/></a>
                </div>
            </div>
        </div>
    </body>
</html>