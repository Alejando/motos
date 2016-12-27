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
                <p style="font-size: 20px; color: #1893D7;">¡Gracias por elegirnos!</p>
                <div>
                    <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top;">
                        No. Orden <b>{{$order->id}}</b>
                    </div>
                    <div style="width: 49%; text-align: right; display: inline-block; vertical-align: top;">
                        Fecha de compra: <b>{{$order->getDateTiemeCreateAt()->format('Y/m/d')}}</b>
                    </div>
                </div>
                <p style="text-align: left;">
                    <b style="color: #1893D7;">Resúmen de Compra</b>
                <div style="border-top: solid 3px #8DC63F;">
                    <div style="border: solid 1px #CFE0EF; margin: 3px 0 0 0;">
                        @foreach($order->items as $i => $item) 
                            <div  {!!($i%2 ? 'style="background: #ecf0f1;"' : '-')!!}> 
                                <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                                     {{$item->product->name}} {{($item->quantity>1 ? 'x'.$item->quantity:'')}}
                                </div>
                                <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                                  {{Helpers::formatCurrency($item->price * $item->quantity)}}
                                </div>
                            </div>
                        @endforeach
                        @if($order->coupon)
	                        <div style="border-top: solid 1px #CFE0EF; background: #C1D72E;">
	                            <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%; border-right: solid 1px #FFF;">
	                                <span style="font-size: 13px; color: #FFF;">Descuento cupón</span>
	                            </div>
	                            <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
	                                <span style="color: #FFF;">- {{Helpers::formatCurrency($order->getAmountCoupon())}}</span>
	                            </div>
	                        </div>
                        @endif
                        <div style="border-top: solid 1px #CFE0EF;">
                            <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%; border-right: solid 1px #CFE0EF;">
                                <span style="font-size: 13px;">Subtotal</span>
                            </div>
                            <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                                {{ Helpers::formatCurrency($order->getSubTotal())}}
                            </div>
                        </div>
                        <div style="border-top: solid 1px #CFE0EF;">
                            <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%; border-right: solid 1px #CFE0EF;">
                                <span style="font-size: 13px;">Envío</span>
                            </div>
                            <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                                {{ Helpers::formatCurrency($order->getShipping())}}
                            </div>
                        </div>
                        <div style="background: #ecf0f1;">
                            <div style="width: 45%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%; border-right: solid 1px #CFE0EF;">
                                <span style="font-size: 13px;">Total</span>
                            </div>
                            <div style="width: 45%; text-align: right; display: inline-block; vertical-align: top; color: #7F8082; padding: 2%;">
                                {{ Helpers::formatCurrency($order->getTotalWhitShpping())}}
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:30px; font-size: 13px;">
                    <div style="width: 48%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082;">
                        <span style="color: #1893D7;">Dirección de Envío</span><br />
                        {{$order->address->street}} {{$order->address->street_number}} {{$order->address->suite_number}}<br />
                        {{$order->address->neighborhood}} {{$order->address->city}} <br>
                        C.P. {{$order->address->postal_code}} <br />
                        {{$order->address->state->name}}, {{$order->address->country->name}}
                    </div>
                    <div style="width: 48%; text-align: left; display: inline-block; vertical-align: top; color: #7F8082;">
                        {{--
                        <span style="color: #1893D7;">Método de Pago</span><br />
                        Transferencia bancaria<br />
                        Cuenta: 0000000000000
                        --}}
                    </div>
                </div>

                <a href="{{route('user.getOrder',['order'=>$order->id])}}" style="background: #1893D7; color: #FFF; display: inline-block; padding: 8px 15px 8px 15px; text-decoration: none; margin: 20px 0 20px 0;">Consultar Pedido en Línea</a>
                </p>
            </div>
            <div style="background: #002B53; padding: 10px;">
                <div style="width: 49%; text-align: left; display: inline-block; vertical-align: top; color: #FFF;">
                    <span style="display: block; padding: 10px 0 0 0;">
                        Horario de atención: 00:00 a 00:00<br />
                        <a href="" style="font-size: 12px; color: #FFF; text-decoration: none;">Aviso de privacidad</a>
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
    </body>
</html>