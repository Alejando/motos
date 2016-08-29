<?php 
$imgs = $auction->getUrlImg();
/* @var $fechaInicio DateTime */
$fechaInicio = new \DateTime($auction->start_date); 
$fechaInicio->setTimezone(new \DateTimeZone("America/Mexico_City"));
?>
<div class="fancy-close">
    <div class="">
        <div class="col-sm-6 col-sm-push-5 col-md-6 text-center">
            <div class="descripcion-fancy">
                <div class="fancybox-close text-right">
                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                </div>
                <div class="fancy-titulo">{{$auction->title}}</div>
                <div class="leyenda-subasta">
                    <div>Puedes subastar desde:</div>
                    <div class="rango-ofertas">{{currency($auction->min_offer, config('app.currency'))}} - {{Currency::format($auction->max_offer, config('app.currency'))}}</div>
                </div>
                <div class="btns-descripcion"></div>
                <div class="fancy-txt">
                    {{$auction->description}}
                </div>
                <div style="padding: 10px">
                    Llévatelo por menos de <b>{{Currency::format(ceil($auction->max_price), config('app.currency'))}}</b>
                    en lugar de <b>{{Currency::format(ceil($auction->real_price), config('app.currency'))}}</b> (precio real)
                </div>
                <div style="padding: 10px">Inicia el <b>{{$fechaInicio->format('d/m/Y')}}</b> a las <b>{{$fechaInicio->format('H:i')}}</b></div>
                <div class="producto-boton-entrar">
                    <a class="link-subasta transition-0-3" href="{{route('auction.enrollment-form', ['auction' => $auction->code])}}">
                        <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                    </a>
                </div>
            </div>
        </div>
        @if(isset($imgs['fancy-box-thumbailn'][0]))
        <div class="col-sm-6 col-sm-pull-6 col-md-4 col-md-offset-1 text-center">
            <div class="producto-fancy ">
                <div class="recorte-superior"></div>
                <div class="producto-fancy-cover">
                    <span class="precio-cover">{{Currency::format($auction->cover, config('app.currency'))}}</span>
                    <span>Tu asiento</span>
                </div>
                <div id="img-principal" class="producto-fancy-img">
                    <img class="zoom_mw" src="{{$imgs['fancy-box-thumbailn'][0]}}" data-zoom-image="{{$imgs['fancy-box-zoom'][0]}}" alt="{{$auction->title}}" title="{{$auction->title}}">
                </div>
                <div class="recorte-inferior"></div>
            </div>
        </div>
        @else 
        <div class="col-sm-3 col-md-3 col-md-offset-0 text-center fancybox-close">

        </div>
        @endif
        <div class="producto-fancy-img-galeria row-centered bg-blanco">
            @foreach($imgs["fancy-box-small"] as $i =>  $img)
            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 col-centered nopadding">
                <div class="frame-galeria gal-1">
                    <img src="{{$img}}" alt="{{$auction->title}}" title="{{$auction->title}}">
                </div>
            </div>
            @endforeach
            <div style="clear: both;"></div>
        </div>
    </div>
</div>