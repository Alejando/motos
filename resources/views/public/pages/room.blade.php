@extends('public.base')
@section('body')
<div ng-controller="public.roomCtrl">
        <section class="slideshow container-fluid patrongg">
            <div class="banner-container">
                <div class="galeria-detalle">
                    <div class="imagen-principal">
                        <img src="{{$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <section class="banner-description container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row banner-data transition-0-3">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info subasta-verde">
                                <span class="subasta-tiempo countdown" expiration="{{$auction->start_date}}"></span>
                            </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter">
                                <div id="titulo-detalle" class="t-detalle">
                                    - {{$auction->title}} -
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter">
                                <a class="link-subasta-cont" href="#fancy-subasta">
                                    <span class="btn-contador"><span id="subasta-count">{{$auction->bids}}</span> Pujas</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </section>
    <!-- Contenido General -->
	
    <div class="fluid-container nopadding">
        <div class="detalle-divider"></div>
    </div>
    <div class="fluid-container bg-blanco">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 rango-subasta">
                    <p>Puedes subastar desde:</p>
                    <div>
                        <div id="rango-smin" class="precio-rango">{{currency($auction->min_offer, config('app.currency'))}}</div><div id="rango-smax" class="precio-rango">{{currency($auction->max_offer, config('app.currency'))}}</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 total-subastado">
                    <div id="subasta-actual" class="precio-subasta">@{{objAuction.last_offer | currency : '$'}}</div>
                    <p>Ultima oferta</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid nopadding bg-naranja" ng-show="objAuction.isStarted()">
        <div class="container">
            <div class="row">
                <div class="col-md-6 panel-oferta">
                    <p>Ingresa tu oferta</p>
                    <div style="font-size:55px">@{{rangeOferta.max  | currency : '$' }}</div>
                    <div class="align-oferta">
                        <div  style="width: 350px;" range-slider  min="rangeOferta.limitMin" pin-handle="min"  max="rangeOferta.limitMax" model-min="rangeOferta.min" model-max="rangeOferta.max"></div>
                    </div>
                    <div class="btn-w" ng-click="placeBid()">Ofertar</div>
                </div>
                <div class="col-md-6 mejor-postor">
                    <div class="rebase-izq"></div>
                    <div class="boleto-postor">
                        <div class="msje-postor">
                            <span class="hey">HEY!</span>
                            <span class="hey-msje">Mira quién<br>lleva la delantera</span>
                        </div>
                        <div class="boleto-divider"></div>
                        <div class="usr-postor">
                            @{{objAuction.username_top || '¡Se el primero!'}}
                        </div>
                    </div>
                    <div class="rebase-der"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid nopadding bg-gris">
        <div class="container">
            <div class="row">
                <div class="col-md-6 producto-info">
                    <h2>{{$auction->title}}</h2>
                    <div>{{$auction->description}}</div>
                    <div class="info-divider"></div>
                    <h3>¡Cuéntale a un amigo!</h3>
                    <img src="{{asset('img/contacto.png')}}" class="img-responsive">
                </div>
                <div class="col-md-6 video-producto">
                    <iframe width="420" height="315" src="http://www.youtube.com/embed/QH2-TGUlwu4?vq=hd1080&controls=0&iv_load_policy=3&rel=0&showinfo=0&color=white&disablekb=1" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="fluid-container relacionados">
            <div class="container">
                    <div class="row">
                        @foreach ($related as $rel)
                        <div class="product-container col-md-3 col-sm-6 col-xs-12">
                            <div class="producto oferta-verde">
                                <div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
                                <div class="img-subasta">
                                    <img src="{{$rel->getUrlCover($rel::COVER_VERTICAL)}}" alt="{{$rel->title}}" title="{{$rel->title}}">
                                </div>
                                <div class="leyenda-subasta">
                                    <div>Puedes subastar desde:</div>
                                    <div class="rango-ofertas">{{currency($rel->min_offer, config('app.currency'))}} - {{currency($auction->max_offer, config('app.currency'))}}</div>
                                </div>
                                <div class="producto-hover transition-0-3">
                                    <div class="producto-titulo">{{$rel->title}}</div>
                                    <div class="producto-actions">
                                        <div class="producto-heart"></div>
                                        <span class="producto-separador"></span>
                                        <div class="producto-hammer" id_producto="{{$rel->code}}"></div>
                                    </div>
                                    <div class="producto-cover">
                                        {{currency($rel->cover, config('app.currency'))}}
                                    </div>
                                    <div class="leyenda-cover">
                                        COVER
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
    </div>
</div>


    <!-- /Contenido General -->
@stop

@section('head')
<script type='text/javascript'>
var auction =  {!! $auction !!}; 

</script>
@stop