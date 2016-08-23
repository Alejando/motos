<?php $imgs = $auction->getUrlImg();?>
<div class="fancy-close">
    <div class="row">
        @if(isset($imgs['fancy-box-thumbailn'][0]))
        <div class="col-sm-6 col-md-4 col-md-offset-1 text-center fancy-close">
            <div class="producto-fancy ">
                <div class="recorte-superior"></div>
                <div class="producto-fancy-cover">
                    <span class="precio-cover">{{Currency::format($auction->cover, config('app.currency'))}}</span>
                    <span>Tu Lugar</span>
                </div>
                <div id="img-principal" class="producto-fancy-img">
                    <img class="zoom_mw" src="{{$imgs['fancy-box-thumbailn'][0]}}" data-zoom-image="{{$imgs['fancy-box-zoom'][0]}}" alt="" title="">
                </div>
                <div class="producto-fancy-img-galeria">
                    @foreach($imgs["fancy-box-small"] as $i =>  $img)
                    <div class="col-xs-4 nopadding">
                        <div class="frame-galeria gal-1">
                            <img src="{{$img}}" alt="" title="">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="recorte-inferior"></div>
            </div>
        </div>
        @else 
            <div class="col-sm-3 col-md-3 col-md-offset-0 text-center fancy-close">
                
            </div>
        @endif
        <div class="col-sm-6 col-md-6 text-center fancy-close">
            <div class="descripcion-fancy">
                <div class="fancy-titulo">{{$auction->title}}</div>
                <div class="leyenda-subasta">
                    <div>Puedes subastar desde:</div>
                    <div class="rango-ofertas">{{currency($auction->min_offer, config('app.currency'))}} - {{Currency::format($auction->max_offer, config('app.currency'))}}</div>
                </div>
                <div class="btns-descripcion"></div>
                <div class="fancy-txt">
                    {{$auction->description}}
                </div>
                <div class="producto-boton-entrar">
                    <a class="link-subasta transition-0-3" href="{{route('auction.enrollment-form', ['auction' => $auction->code])}}">
                        <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>