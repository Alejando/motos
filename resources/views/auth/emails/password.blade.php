@extends('mails.html.reset-password')
@section('message')
    <div class="banner" style="background-image: url('{{asset('img/mail/bg-banner-mail.jpg')}}');padding: 18px 0;color: #fff;">
        <h2 style="text-transform: uppercase;margin: 40px auto;font-weight: 100;font-size: 40px;">Recuperación de contraseña</h2>
    </div>
    <div class="mensaje" style="color: #003937; padding: 0 10%;">
        <p style="margin: 16px auto;">Has realizado una solicitúd para la recuperación de tu contrasñea, para recuperarla da click en el siguiente enlace.</p>
        <hr>
        <a style="margin:auto; border:1px solid #3c9ba2; padding:10px 5px; width:150px; background-color:#00bcb6; display:inline-block; text-decoration:none; color:#ffffff;" href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">Recuperar password</a>
        <hr>
        <p style="margin: 16px auto;">Si no realizado esta petición por favor ignora este mensaje.</p>
    </div>
@endsection