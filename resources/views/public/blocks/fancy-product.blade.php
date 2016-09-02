<?php 
$imgs = $auction->getUrlImg();
$numItems = count($imgs['fancy-box-small']);
$widthGallery = $numItems * 104;
$widthGallery = 'width: '.$widthGallery.'px';
/* @var $fechaInicio DateTime */
$fechaInicio = new \DateTime($auction->start_date); 
$fechaInicio->setTimezone(new \DateTimeZone("America/Mexico_City"));
?>
<div class="fancy-close">
    <script>
        var numItems = {{$numItems}} - 1;
    </script>
    <div class="">
        <div class="col-sm-6 col-sm-push-6 col-md-7 col-md-push-5 text-center close-fancy">
            <div class="descripcion-fancy">
                <div class="fancybox-close text-right">
                    <i class="fa fa-times fa-2x close-fancy" aria-hidden="true"></i>
                </div>
                <div class="fancy-titulo">{{$auction->title}}</div>
                <div class="leyenda-subasta">
                    <div>Puedes subastar desde:</div>
                    <div class="rango-ofertas">{{currency($auction->min_offer, config('app.currency'))}} - {{Currency::format($auction->max_offer, config('app.currency'))}}</div>
                </div>
                <div class="btns-descripcion"></div>
                <div class="fancy-txt">
                    {!!nl2br($auction->description)!!}
                </div>
                <div style="padding: 10px">
                    Llévatelo por menos de <b>{{Currency::format(ceil($auction->max_price), config('app.currency'))}}</b>
                    en lugar de <b>{{Currency::format(ceil($auction->real_price), config('app.currency'))}}</b> (precio real)
                </div>
                <div style="padding: 10px">Inicia el <b>{{$fechaInicio->format('d/m/Y')}}</b> a las <b>{{$fechaInicio->format('H:i')}}</b></div>
                @if($auction->isBuyable())
                <div class="producto-boton-entrar">
                    <a class="link-subasta transition-0-3" href="{{route('auction.enrollment-form', ['auction' => $auction->code])}}">
                        <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @if(isset($imgs['fancy-box-thumbailn'][0]))
        <div class="col-sm-6 col-sm-pull-6 col-md-5 col-md-pull-7 text-center close-fancy">
            <div class="producto-fancy ">
                <div class="recorte-superior"></div>
                @if($auction->isPreSaleDay())<div class="label-preventa"></div>@endif
                <div class="producto-fancy-cover">
                    <span>Tu asiento</span>
                    <span class="precio-cover">
                        @if($auction->isPreSaleDay())
                        <span class="strike">{{Currency::format($auction->getOriginalCover(), config('app.currency'))}}</span>
                        @endif
                        <span class="{{$auction->isPreSaleDay() ? 'oferta':''}}">{{Currency::format($auction->cover, config('app.currency'))}}</span>
                    </span>
                    @if($auction->isPreSaleDay())
                    <span>¡Precio preventa!</span>
                    @endif
                </div>
                <div id="img-principal" class="producto-fancy-img">
                    <div class="fancy-gallery-control control-left"><i class="fa fa-angle-left fa-3x" aria-hidden="true"></i></div>
                    <div class="fancy-gallery-control control-right"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></i></div>
                    <img id="fancy-zoom" class="zoom_mw" src="{{$imgs['fancy-box-thumbailn'][0]}}" data-zoom-image="{{$imgs['fancy-box-zoom'][0]}}" alt="{{$auction->title}}" title="{{$auction->title}}">
                </div>
                <section class="fancy-gallery">
                    <div class="fancy-fallery-container" style="{{$widthGallery}}">
                        @foreach($imgs["fancy-box-small"] as $i => $img)
                        <a href="#" class="frame-gallery gal-{{$i}}{{$i == 0 ? ' active' : ''}}" gal-num="{{$i}}" data-image="{{$imgs["fancy-box-thumbailn"][$i]}}" data-zoom-image="{{$imgs["fancy-box-zoom"][$i]}}">
                            <img src="{{$imgs["fancy-box-small"][$i]}}" alt="{{$auction->title}}" title="{{$auction->title}}">
                        </a>
                        @endforeach
                    </div>
                </section>
                <div class="recorte-inferior"></div>
            </div>
        </div>
        @else 
        <div class="col-sm-3 col-md-3 col-md-offset-0 text-center fancybox-close">

        </div>
        @endif
    </div>
</div>
