@extends('public.base')
@section('body')

<section class="container detalle-pago-subasta">
    <div class="row">
        <div class="col-sm-6">
            <img class="img-responsive thumbnail" src="{{$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}">
        </div>
        <div class="col-sm-6 subasta-datos">
            <h2 class="subasta-nombre">{{$auction->title}}</h2>
            <p class="subasta-descripcion">{{$auction->description}}</p>
            <div class="col-xs-6">
                <div class="caja-contador participacion-p">
                    <span class="cant-participacion">{{$auction->users_limit}}</span>
                    <p>Maximo de participantes</p>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="caja-contador ganado-p">
                    <span class="cant-ganado">{{$auction->total_enrollments}}</span>
                    <p>Participantes registrados</p>
                </div>
            </div>
            <div style="clear:both;"></div>
            <a class="btn btn-block btn-primary subasta-boton-pago" href="{{route('auciton.checkout',['code' => $auction->code])}}">Únete</a>
        </div>
    </div>
    <div class="row banner-data transition-0-3">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info">
            <span class="banner-leyenda">Puedes subastar desde:</span>
            <span class="banner-range">
                <span class="rango-min">
                    {{currency($auction->min_offer, config('app.currency'))}}
                </span>
                -
                <span class="rango-max">
                    {{Currency::format($auction->max_price, config('app.currency'))}}
                </span>
            </span>
        </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info subasta-verde">
            <span class="subasta-tiempo countdown" expiration="{{$auction->start_date}}"></span>
            <span class="subasta-leyenda">Para la subasta</span>
        </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info">
            <span class="subasta-cover">Cover: {{currency($auction->cover, config('app.currency') )}}</span>
        </div>
    </div>
</section>

@stop