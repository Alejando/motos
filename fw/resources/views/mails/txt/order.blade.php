@extends('mails.frames.common-txt')

@section('message')
    ¡Gracias por elegirnos!
    
    No. Orden {{$order->id}}
    Fecha de compra: {{$order->getDateTiemeCreateAt()->format('Y/m/d')}}
    Resúmen de Compra
    @foreach($order->items as $i => $item) 
        {{$item->product->name}} {{($item->quantity>1 ? 'x'.$item->quantity:'')}} {{Helpers::formatCurrency($item->price * $item->quantity)}}
    @endforeach
    @if($order->coupon)
            Descuento cupón: - {{Helpers::formatCurrency($order->getAmountCoupon())}}
    @endif
        Subtotal: {{ Helpers::formatCurrency($order->getSubTotal())}}
        Envío: {{ Helpers::formatCurrency($order->getShipping())}}
        Total:  {{ Helpers::formatCurrency($order->getTotal())}}

    Dirección de Envío
            {{$order->address->street}} {{$order->address->street_number}} {{$order->address->suite_number}}
            {{$order->address->neighborhood}} {{$order->address->city}} 
            C.P. {{$order->address->postal_code}} 
            {{$order->address->state->name}}, {!!$order->address->country->name!!}
                    
    Consultar Pedido en Línea: {{route('user.getOrder',['order'=>$order->id])}}" 
@stop 
