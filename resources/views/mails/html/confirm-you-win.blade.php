@extends('mails.frames.common')
@section('message')
    <div class="banner" style="background-image: url('{{asset('img/bg-banner-mail.jpg')}}');padding: 18px 0;">
        <div style="width: 120px; height: auto; background-color: #fff; border: 2px solid #866509;margin: auto;border-radius: 10px; padding: 2px;">
            <img style="width: 100%;" src="{{$auction->getUrlCover($auction::COVER_HORIZONTAL)}}">
        </div>
        <h2 style="color: #d5a00f; text-transform: uppercase; margin: 5px auto;font-weight: 100;">
            {{$auction->title}}
        </h2>
        <p style="color: #fff; margin: 2px auto 0;text-transform: uppercase;">
            SUBASTA #<span>{{$auction->code}}</span>
        </p>
    </div>
    <div class="cinta-felicidades" style="background-color: #284f53; color: #fff;padding: 10px 0;">
        <h2 style="margin: 0;font-weight: 100;">
            ¡Felicidades <span style="font-weight: bold;">{{$user->name}}</span>!
        </h2>
    </div>
    <div class="total-pagar" style="background-color: #efefef; color: #00bcb6;padding: 20px 0;">
        <div style="width: 45%; display: inline-block;">
            <div class="total-subastas" style="border: 1px solid #00bcb6; width: 50%; margin: auto; padding: 20px;">
                Total de ofertas<br><span style="font-size: 24px; font-weight: bold;">{{--$auction->getTotalBids()--}}</span>
            </div>
        </div>
        <div style="width: 53%; display: inline-block; font-size: 20px;">
            <div style="width: 49%; display: inline-block;text-align: center;">Oferta final: </div>
            <div style="width: 49%; display: inline-block; text-align: center;color: #003937;"> {{Currency::format($auction->last_offer, config('app.currency'))}} MXN</div>
        </div>
    </div>
    <div class="mensaje" style="color: #003937; padding: 10px 5%;">
        <p style="margin: 5px">Te informamos que tu oferta fue la más alta para:</p>
        <p style="margin: 5px auto;color: #d5a00f;">{{$auction->title}}</p>
        <p style="margin: 5px auto;">Agradecemos tu participación en la subasta.</p>
        <p style="margin: 16px auto;">Para concluir el proceso, es necesario realizar el pago de tu oferta en el siguiente enlace:</p>
        <a href="{{route('payment.win', [
            'code'=>$auction->code
        ])}}" style="color: #fff; text-decoration: none;">
            <div style="margin: auto;border: 1px solid #3c9ba2;padding: 10px; width: 100px;background-color: #00bcb6;display: inline-block;font-size: 12px;">PAGO EN LÍNEA</div>
        </a>
        <p style="margin: 16px auto;text-align: left;font-size: 14px;">
            Pagar en efectivo:
            <ul style="text-align: left;font-size: 12px;">
                <li>Banco BANAMEX</li>
                <li>Cuenta 70071598622</li>
                <li>Clabe 002320700715986222</li>
            </ul>
        </p>
        <p style="margin: 16px auto;font-size: 12px;text-align: left;">
            SI TU PAGO ES EN EFECTIVO, <span style="color: #797979;">es importante que nos hagas llegar comprobante de pago al correo: pagos@glimglam.mx para que tu compra sea procesada correctamente.
            Para cualquier duda estamos a tus ordenes en:</span><a href="mailto:dudas@glimglam.mx" style="color: #003937;"> dudas@glimglam.mx</a>
        </p>
        <p style="font-size: 14px;"><span style="font-size: 22px; font-weight: bold;">Gracias,</span><br>Equipo GlimGlam</p>
    </div>
    <div class="metodo-pago" style="background-color: #efefef; color: #003937;padding: 5px 0;">
        <div style="text-align: center;"><img src="{{asset('img/metodo-pago.png')}}" height="20px"></div>
    </div>
@stop