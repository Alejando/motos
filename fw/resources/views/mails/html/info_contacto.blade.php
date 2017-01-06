<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <div style="min-width: 300px; max-width: 600px; margin: auto; text-align: center;font-family: Tahoma, Geneva, sans-serif; background: #f9f9f9;">
            <div style="padding: 2%; text-align: left; background: #FFF; box-shadow: 0 1px 3px #ddd;">
                <img src="{{asset('img/mail/logo.png')}}" />
            </div>
            <div style="padding: 10px 60px 10px 60px;">
                <p style="font-size: 20px; color: #1893D7;">¡Solicitud de información!</p>
                <p style="font-size: 16px;">
                	<b>Nombre:</b> {{$contacto_info->nombre}} <br><br>
                	<b>Teléfono:</b> {{$contacto_info->movil}} <br><br>
                	<b>Correo:</b> {{$contacto_info->correo}} <br><br>
                	<b>Forma de contacto:</b> {{$contacto_info->forma}} <br><br>
                	<b>Horario preferente:</b> de {{$contacto_info->hora_inicio}} a {{$contacto_info->hora_final}}<br><br>
                	<b>Mensaje:</b>  {{$contacto_info->mensaje}} <br><br>
                </p>
                

            </div>
            <div style="background: #C1D72E;">
                <h2 style="color: #FFF; padding: 20px 0 0 0;">
                                        
                </h2>
                <div style="color: #FFF; text-align: right; margin-right: 10px; margin-bottom: 10px;"></div>
                <div style="background: #002B53; padding: 10px;">
                    <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top; color: #FFF;">
                        <span style="display: block; padding: 10px 0 0 0;">
                            
                            
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
        </div>
    </body>
</html>