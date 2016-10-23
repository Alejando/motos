@extends('mails.frames.common')

@section('message')

            <div class="banner" style="background-image: url('{{asset('img/mail/bg-banner-mail.jpg')}}');padding: 18px 0;">
                <div style="width: 130px; height: auto; margin: auto;">
                        <img src="{{$auction->getUrlCover($auction::COVER_HORIZONTAL)}}" style="width: 100%;">
                </div>
                <p style="margin: 10px auto 0;text-transform: uppercase;color: #d5a00f;font-size: 24px;">
                    {{$auction->title}}
                </p>
            </div>
            <div class="cinta-felicidades" style="background-color: #284f53; color: #fff;padding: 10px 0;">
                <h2 style="margin: 0;font-weight: 100;text-transform: uppercase;">
                    ¡La subasta esta por iniciar!
                </h2>
            </div>
            <div class="mensaje" style="color: #003937; padding: 0 5%;">
                <p style="margin: 16px auto;">
                    Te recordamos que la subasta por <b>{{$auction->title}}</b> en la que te has registrado para participar va a iniciar
                </p>
                <p style="margin: 16px auto;">
                    Inicia: <b>{{Carbon\Carbon::parse($auction->start_date)->format('d/m/Y h:i:s A')}}</b>
                </p>
                <p style="margin: 16px auto 10px;">
                    En este boton puedes acceder a la sala donde se llevara a cabo la subasta
                </p>
                <a href="{{route('auction.room', [
                    'code'=>$auction->code
                ])}}" style="color: #fff; text-decoration: none;">
                    <div style="margin: 20px auto;border: 1px solid #3c9ba2;padding: 10px; width: 100px;background-color: #00bcb6;display: inline-block;">
                        IR A SALA
                    </div>
                </a>
            </div>
@stop