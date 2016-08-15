@extends('mails.html.reset-password')
@section('message')
Abre el siguente enlace para reasignar tu password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
@endsection