@extends('mails.frames.common')

@section('message')
            <div class="banner" style="background-image: url('{{asset('img/mail/bg-banner-mail.jpg')}}');padding: 18px 0;">
                <div style="width: 80px; height: 80px;margin: auto;">
                       {{-- <img src="{{asset('img/ticket.png')}}" style="width: 100%;"> --}}
                </div>
                <p style="color: #fff; margin: 20px 0;text-transform: uppercase;">
                    No. Folio: <span> {{$payment->folio}}</span>
                </p>
            </div>
            <div class="cinta-felicidades" style="background-color: #284f53; color: #fff;padding: 10px 0;">
                <h2 style="margin: 0;font-weight: 100;text-transform: uppercase;">
                    ¡Pago por asiento confirmado!
                </h2>
            </div>
            <div class="mensaje" style="color: #003937; padding: 0 5%;">
                <p style="margin: 16px auto;">
                    Te confirmamos que hemos recibido el pago para participar por:
                </p>
                <p style="margin: 20px auto;text-transform: uppercase;color: #d5a00f;font-size: 24px;">
                    {{$auction->title}}
                </p>
                <p style="margin: 16px auto;">
                    A partir de este momento puedes acceder a la sala de subasta, recuerda agendar la fecha y ser puntual.
                </p>
                <a href="{{route('auction.room', [
                    'code'=>$auction->code
                ])}}" style="color: #fff; text-decoration: none;">
                    <div style="margin: auto;border: 1px solid #3c9ba2;padding: 10px; width: 100px;background-color: #00bcb6;display: inline-block;">
                        IR A SALA
                    </div>
                </a>
                <p style="margin: 16px auto;font-size: 14px;">
                    A continuación te presentamos el resumen de tu pago:
                </p>
            </div>
            <div class="total-pagar" style="background-color: #efefef; color: #00bcb6;padding: 20px 0;margin-top: 20px;">
                <div style="width: 30%; display: inline-block;vertical-align: middle;">
                    <a class="total-subastas" style="display: block;border: 1px solid #00bcb6; width: 75%; margin: auto; padding: 20px;background-color: #fff">
                       {{--'Agendalo en tu<br><span style="font-size: 24px; font-weight: bold;">calendario</span>'--}}
                       <img src="{{$auction->getUrlCover($auction::COVER_HORIZONTAL)}}" style="width: 100%;">
                    </a>
                </div>
                <div style="width: 100%; display: inline-block; font-size: 20px;font-size: 12px; text-align: left;margin-left: 10px;vertical-align: middle; margin-bottom:20px;">
                    <div style="color: #d5a00f;">
                        Hora de inicio 
                    </div>
                    <div style="color: #003937;">

                        {{Carbon\Carbon::parse($auction->start_date)->format('d/m/Y h:i:s A')}}
                    </div>
                    <div style="margin-top: 10px;">
                        Hora de fin 
                    </div>
                    <div style="color: #003937;">
                        {{Carbon\Carbon::parse($auction->end_date)->format('d/m/Y h:i:s A')}}
                    </div>
                </div>
                <div style="width: 100%; display: inline-block; font-size: 15px; vertical-align: middle; text-align: left;">
                    <div style="display: inline-block;text-align: left;width: 40%;">
                        Subtotal:
                    </div>
                    <div style="display: inline-block;text-align: right;color: #003937;">
                        {{Currency::format($payment->subtotal, config('app.currency'))}}
                    </div>
                    <br>
                    <div style="display: inline-block;text-align: left;width: 40%;">
                        IVA:
                    </div>
                    <div style="display: inline-block;text-align: right;color: #003937;">
                        {{Currency::format($payment->iva, config('app.currency'))}}
                    </div>
                    <br>
                    <div style="display: inline-block;text-align: left;width: 40%;">
                        Total:
                    </div>
                    <div style="display: inline-block;text-align: right;color: #003937;">
                        {{Currency::format($payment->amount, config('app.currency'))}}
                    </div>
                </div>
            </div>
            <div class="mensaje" style="color: #003937; padding: 0 5%;">
                <p style="font-size: 14px;"><span style="font-size: 22px; font-weight: bold;">
                        Gracias,</span><br>Equipo GlimGlam
                </p>
            </div>
@stop