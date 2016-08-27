@extends('public.base')
@section('body')

<section class="container detalle-pago-subasta">
    <div class="row">
        <div class="col-sm-12">
            <div class="chk-head">Detalles de tu asiento</div>
            <div class="col-sm-6 borde-thumb">
                <i class="fa fa-ticket cover-t" aria-hidden="true"></i>
                <img src="{{$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}" class="thumb-cover">
            </div>
            <div class="col-sm-6 text-center">
                <p>
                    Acceso a:
                </p>
                <h3 class="subasta-nombre">
                    {{$auction->title}}
                </h3>
                <p>
                    Fecha de inicio:
                </p>
                <p>
                    <span class="subasta-tiempo2 countdown" start_date="{{$auction->start_date}}"></span>
                </p>
            </div>
            <div class="col-xs-3">
                <div class="caja-contador participacion-p">
                    <span class="cant-participacion">{{$auction->users_limit}}</span>
                    <p>Maximo de participantes</p>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="caja-contador ganado-p">
                    <span class="cant-ganado">{{$auction->total_enrollments}}</span>
                    <p>Participantes registrados</p>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="col-sm-12" style="margin-top: 35px;">
            <p class="text-center">Recuerda estar puntual en el cuarto de juego, ¡cada minuto que pase tendrás menos oportunidades de ganar!</p>
            <div style="clear:both;"></div>
        </div>
        <div class="row">
            <p class="text-center"><a class="btn btn-primary" href="{{asset('subastas/juego/'.$auction->code)}}">Entrar al juego</a></p>
        </div>
    </div>
</section>

@stop