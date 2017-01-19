@extends('mails.frames.common-txt')
@section('message')

    ¡Gracias por elegirnos!

    No. Orden {{$order->id}}
    Fecha de compra: {{$order->getDateTiemeCreateAt()->format('Y/m/d')}}
    
    Tu pedido ha sido enviado
    
    Puedes consultar tu pedido con el numero de guia {{$order->guia}} en:
    
        {{$order->urlguia}}

    Consultar Pedido en Línea: {{route('user.getOrder',['order'=>$order->id])}}    
@stop    