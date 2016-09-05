@extends('mails.html.reset-password')
@section('message')
    <div class="banner" style="background-image: url('{{asset('img/mail/bg-banner-mail.jpg')}}');padding: 18px 0;color: #fff;">
        <h2 style="text-transform: uppercase;margin: 40px auto;font-weight: 100;font-size: 40px;">Restablecer contraseña</h2>
    </div>
    <div class="mensaje" style="color: #003937; padding: 0 10%;">
        <p style="margin: 16px auto;">Has realizado una solicitúd para restablecer tu contraseña, para recuperarla da clic en el siguiente enlace.</p>
        <hr>
        <a style="margin:auto; border:1px solid #3c9ba2; padding:10px 5px; width:150px; background-color:#00bcb6; display:inline-block; text-decoration:none; color:#ffffff;" href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">Restablecer contraseña</a>
        <hr>
        <p style="margin: 16px auto;">Si no has realizado esta petición por favor ignora este mensaje.</p>
    </div>
@endsection