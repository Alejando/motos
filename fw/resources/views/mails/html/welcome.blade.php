@extends('mails.frames.common')

@section('style')
            .message_body{
                padding: 10px 60px 10px 60px;
            }
            .title_message{
                font-size: 20px; color: #1893D7;
            }
            .text_message{
                font-size: 16px;
            }
            .login{
                background: #1893D7; color: #FFF; 
                display: inline-block; 
                padding: 8px 15px 8px 15px; 
                text-decoration: none; 
                margin: 20px 0 20px 0;
            }
            .user_section{
                background: #C1D72E;
            }
            .user_data{
                color: #FFF; 
                padding: 20px 0 0 0;
            }
@stop

@section('message')
<div class="message_body">
    <p class="title_message">¡Gracias por registrarse!</p>
    <p class="text_message">Nuestros colaboradores estarán pendientes de brindarle una excelente atención.</p>
    <a href="#" class="login">Iniciar Sesión</a>
</div>
<div class="user_section">
    <h2 class="user_data">
        {{$user->name}}<br />
        {{$user->email}}
    </h2>
@stop


