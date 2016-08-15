@extends('mails.frames.common')

@section('style')
<style>
    .welcome {
        color:blue;
    }
</style>
@stop

@section('message')
<div class="banner" style="background-image: url('{{asset('img/mail/bg-banner-mail.jpg')}}');padding: 18px 0;color: #fff;">
        <h2 style="text-transform: uppercase;margin: 40px auto;font-weight: 100;font-size: 40px;">¡BIENVENIDA <span style="">Karla!</span></h2>
</div>
<div class="mensaje" style="color: #003937; padding: 0 10%;">
        <p style="margin: 16px auto;font-size: 20px;margin-top: 30px;">Gracias por registrarse en <a href="http://glimglam.mx" style="color: #003937;">glimglam.mx</a></p>
        <p style="margin: 16px auto;">A partir de este momento, podrás acceder a las subastas de nuestros productos exclusivos, asimismo recibirás notificaciones de subastas por comenzar.</p>
        <hr>
        <a href="http://glimglam.mx/login" style="color: #fff; text-decoration: none;">
            <div style="margin: 10px auto 30px auto;border: 1px solid #3c9ba2;padding: 10px; width: 100px;background-color: #00bcb6;display: inline-block;">Iniciar Sesión</div>
        </a>
</div>
<div class="datos" style="background-color: #efefef; color: #003937;padding: 15px 30px;">
        <div style="width:49%;text-align: left;display: inline-block;vertical-align: top;">
                <h3 style="text-align: center;">Tus datos</h3>
                <p style="text-align: center;">Karla Pérez</p>
                <p style="text-align: center;">kperez@gmail.com</p>
                <p style="text-align: center;">Intereses:</p>
                <table style="text-align: center; font-size: 12px;" width="100%">
                    <tr>
                      <td style="padding: 7px 0;">Joyería</td>
                      <td style="padding: 7px 0;">Moda/Accesorios</td>
                    </tr>
                    <tr>
                      <td style="padding: 7px 0;">Electrónica</td>
                      <td style="padding: 7px 0;"></td>
                    </tr>
                    <tr>
                      <td style="padding: 7px 0;">Zapatos</td>
                      <td style="padding: 7px 0;"></td>
                    </tr>
                  </table>
        </div>
        <div style="width:49%;display: inline-block;vertical-align: top;">
                <h3 style="text-align: center;">Acerca de GlimGlam</h3>
                <img src="{{asset('img/mail/btn-videoplayoverlay.png')}}" style="width: 90%;">
        </div>
</div>
<p style="font-size: 14px;"><span style="font-size: 22px; font-weight: bold;">Gracias,</span><br>Equipo GlimGlam</p>
@stop


@section('oculto')
Welcome! <span class="welcome">s{{$user->name}}</span>
    {{$user->email}}
    {{env('EMAIL_TEST_DEVELOPER')}}
    <img src="{{$message->embed("img/logo.png")}}">
@stop