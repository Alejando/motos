@extends('mails.frames.common-txt')

@section('message')
¡Gracias por registrarse!
Nuestros colaboradores estarán pendientes de brindarle una excelente atención.
    {{$user->name}}
    {{$user->email}}
    Password: {{$rawPassword}}
@stop 