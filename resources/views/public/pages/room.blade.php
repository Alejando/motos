@extends('public.base')
@section('body')
<div ng-controller="public.roomCtrl" class="section-room" style="display: none">
    <section class="fancy-producto">
    </section>
            
    
        <section class="slideshow container-fluid patrongg">
            <div class="banner-container">
                <div class="banner" >
                    <ul class="banner-list">
                        <?php $urlCovers = $auction->getUrlImg([$auction::COVER_SLIDER_UPCOMING])[$auction::COVER_SLIDER_UPCOMING]?>
                        @foreach($urlCovers as $url)
                        <li class="link-subasta no-border" id_producto="{{$auction->code}}" data-transition="fade" data-masterspeed="700" 
                            data-slotamount="8" 
                            id-producto="{{$auction->code}}" 
                            product-name="{{$auction->title}}" 
                            rangomin="{{currency($auction->min_offer, config('app.currency'))}}" 
                            rangomax="{{Currency::format($auction->max_offer, config('app.currency'))}}" 
                            start_date="{{$auction->start_date}}">
                            <img src="{{$url}}"/>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <section class="banner-description container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row banner-data transition-0-3">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info subasta-verde">
                                <timer interval="1000" language="es" class="subasta-tiempo" 
                                    ng-show="objAuction.isStandBy()"
                                    end-time="objAuction.start_date">
                                    <small>Inicia en</small><br>
                                    <span ng-show="days > 0">@{{days}} día<span ng-show="days > 1">s</span>,</span>
                                    <span ng-show="hours > 0">@{{hours}} hr,</span>
                                    <span ng-show="minutes > 0">@{{minutes}} min,</span>
                                    @{{seconds}} seg
                                </timer>
                                <timer interval="1000" language="es" class="subasta-tiempo" 
                                    ng-show="objAuction.isStarted()"
                                    end-time="objAuction.end_date">
                                        <small>Finaliza en</small><br>@{{hours}} hr, @{{minutes}} min, @{{seconds}} seg
                                </timer>
                                <div class="subasta-tiempo" ng-show="objAuction.isFinished()">
                                    La subasta ha terminado
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter">
                                <div id="titulo-detalle" class="t-detalle">
                                    {{$auction->title}}
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter">
                                <a class="link-subasta-cont" href="#fancy-subasta">
                                    <span class="btn-contador"><span id="subasta-count">@{{objAuction.num_bids}}</span> Ofertas</span>
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
                        <div id="rango-smin" class="precio-rango">{{currency($auction->min_offer, config('app.currency'))}}</div>
                        <div id="rango-smax" class="precio-rango">{{currency($auction->max_offer, config('app.currency'))}}</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 total-subastado">
                    <div id="subasta-actual" class="precio-subasta" ng-class="{
                            'subasta-verde': objAuction.winner == id_user
                        }">@{{objAuction.last_offer | currency : '$'}}</div>
                    <p>Ultima oferta</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid nopadding bg-naranja" ng-show="objAuction.isStarted() || objAuction.isFinished()">
        <div class="container">
            <div class="row">
                <div class="col-md-6 panel-oferta">
                    <section ng-show="objAuction.isStarted()">
                        <p>Aumenta la oferta</p>
                        <div style="font-size:55px">@{{rangeOferta.max  | currency : '$' }}</div>
                        <div class="align-oferta">
                            <div  style="width: 350px;" range-slider step="0.00" decimal-places="2"  min="rangeOferta.limitMin" pin-handle="min"  max="rangeOferta.limitMax" model-min="rangeOferta.min" model-max="rangeOferta.max"></div>
                        </div>
                        <div class="delay-bid"  ng-show="nextBid>now">
                                <timer interval="1000" language="es"  class="subasta-tiempo" 
                                    end-time="nextBid">
                                        <small>Puedes ofertar en</small><br>@{{minutes}} min, @{{seconds}} seg
                                </timer>
                        </div>
                        <div class="btn-w" ng-click="placeBid()" ng-show="nextBid<=now && !unqualified">Ofertar</div>
                        <div class="col-sm-6 col-sm-offset-3 ofertas-restantes" ng-show="unqualified">
                            Has sido descalificado <br>
                            debido a que no completas <br>
                            la cantidad de ofertas necesarias
                            <a class="btn btn-block btn-primary subasta-boton-pago" href="{{asset('')}}">Entrar a otra sala</a>
                        </div>
                    </section>
                    <section ng-show="objAuction.isFinished()">
                        <p>La Subasta ha terminado</p>
                        <div class="col-sm-4 col-sm-offset-4" ng-show="objAuction.winner != id_user">
                            <a class="btn btn-block btn-primary subasta-boton-pago" href="{{asset('')}}">Entrar a otra sala</a>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4" ng-show="objAuction.winner == id_user">
                            <a class="btn btn-block btn-primary subasta-boton-pago" href="{{route('payment.win', ['code'=>$auction->code])}}">Pagar subasta</a>
                        </div>
                    </section>
                </div>
                <div class="col-md-6 mejor-postor">
                    <section ng-show="objAuction.isStarted()">
                        <div class="rebase-izq"></div>
                        <div class="boleto-postor">
                            <div class="msje-postor">
                                <span class="hey">HEY!</span>
                                <span class="hey-msje">Mira quién<br>lleva la delantera</span>
                            </div>
                            <div class="boleto-divider"></div>
                            <div class="usr-postor">
                                @{{objAuction.winnername || '¡Se el primero!'}}
                            </div>
                        </div>
                        <div class="rebase-der"></div>
                        <div class="ofertas-restantes">
                            Te quedan @{{objAuction.bids - totalBids - totalFaults}} ofertas disponibles<br>
                            Has ofertado @{{totalBids}} veces y has perdido @{{totalFaults}} oportunidades<br>
                            <span ng-show="objAuction.min_bids - totalBids > 0">Necesitas realizar minimo @{{objAuction.min_bids}} ofertas para poder ser ganador
                            Te hacen falta @{{objAuction.min_bids - totalBids}} ofertas</span>
                        </div>
                    </section>
                    <section ng-show="objAuction.isFinished()">
                        <div class="rebase-izq"></div>
                        <div class="boleto-postor">
                            <div class="msje-postor">
                                <span class="hey hey-ganado">@{{objAuction.winner == id_user ? '¡Has ganado!' : '¡El ganador!'}}</span>
                            </div>
                            <div class="boleto-divider"></div>
                            <div class="usr-postor">
                                @{{objAuction.winnername || '¡No hay ganador!'}}
                            </div>
                        </div>
                        <div class="rebase-der"></div>
                    </section>
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
                    <div class="share-room-container">
                        <a id="share-room" class="share-room share-fb" target="_blank" href="{{URL::to('/#!'.$auction->code.'/'.str_slug($auction->title))}}"></a>
                        <a class="share-room share-tw" href="http://twitter.com/share?url={{URL::to('/sub/'.$auction->code)}}&text=¡{{$auction->title}} está siendo subastado!&hashtags=glimglam,subastaonline" title="GlimGlam subastas online" target="_blank"></a>
                    </div>
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
                            @include('public.blocks.product', ['auction'=> $rel,'room'=>true])
                        @endforeach
                    </div>
            </div>
    </div>
</div>


    <!-- /Contenido General -->
@stop

@section('js-scripts')
<script type='text/javascript'>
    var auction =  {!! $auction !!}; 
    var id_user = {{\Auth::user()->id}};

    $('.share-room.share-fb').on('click', function(e) {
        e.preventDefault();
        FB.ui({
          method: 'share',
          display: 'popup',
          picture: {!!json_encode($auction->getUrlCover($auction::COVER_HORIZONTAL))!!},
          description: {!!json_encode($auction->description)!!},
          title: "asdfasdfa ANASD",
          caption: 'GlimGlam subastas online',
          href: this.href,
        }, function(response){});
    });
    
    $('.share-room.share-tw').on("click", function(e) {
        $(this).customerPopup(e);
    });
    
    $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
        // Prevent default anchor event
        e.preventDefault();
        // Set values for window
        intWidth = intWidth || '500';
        intHeight = intHeight || '400';
        strResize = (blnResize ? 'yes' : 'no');

        // Set title and open popup with focus on it
        var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'GlimGlam subastas online'),
            strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
            objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
    }
</script>
<script type="text/javascript" src="{{asset('js/estrasol/room.js')}}"></script>
@stop