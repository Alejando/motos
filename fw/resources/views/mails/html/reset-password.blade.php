@extends('mails.frames.common')
@section('style')
            .header_message, .footer_message{
                padding: 10px 60px 10px 60px;
                text-align: left;
            }
            .welcome_user{
                color: #1893D7;
            }
            .text_message{
                font-size: 14px;
            }
            .login{
                background: #1893D7; color: #FFF; 
                display: inline-block; 
                padding: 8px 15px 8px 15px; 
                text-decoration: none; 
                margin: 20px 0 20px 0;
            }
            .body_message{
                padding: 10px 60px 10px 60px;
            }
            .link{
                background: #1893D7; 
                color: #FFF; 
                display: inline-block; 
                padding: 8px 15px 8px 15px; 
                text-decoration: none; 
                margin: 20px 0 20px 0;
            }
@stop
@section('message')
    <div class="header_message">
		<p class="welcome_user">Estimado/a {{$user->name}}</p>
		<p class="text_message">
			¿Ha olvidado su contraseña?<br />
			Haga click en el vínculo, solo se puede usar una vez y caducará al cabo de 1 día.
		</p>
	</div>
	<div class="body_message">
		<a class="link" href="#">Restablecer Contraseña</a>
	</div>
	<div class="footer_message">
		<p class="text_message">
			Si no desea cambiar su contraseña o no ha solicitado este cambio, ignore y elimine este mensaje.<br/><br/>
			Gracias, <br/>
			El equipo de Bounce.
		</p>
	</div>
@stop