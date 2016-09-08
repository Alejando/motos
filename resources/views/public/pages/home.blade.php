@extends('public.base')
@section('body')
<div ng-controller="public.IndexCtrl">
    <section class="fancy-producto">
      
    </section>
    <section class="slideshow container" style="display: none">
        <div class="banner-container">
            <div class="banner" >
                <ul class="banner-list">
                    @foreach($sliderAuctions as $auction)
                    <li data-slug="{{str_slug($auction->title)}}" class="link-subasta no-border element-banner-list" id_producto="{{$auction->code}}" data-transition="fade" data-masterspeed="100" 
                        data-slotamount="8" 
                        id-producto="{{$auction->code}}" 
                        product-name="{{$auction->title}}" 
                        rangomin="{{currency($auction->min_offer, config('app.currency'))}}" 
                        rangomax="{{Currency::format($auction->max_offer, config('app.currency'))}}" 
                        start_date="{{(new \DateTime($auction->start_date))->format("Y-m-d\TH:i:s")}}">
                        <img ng-src="{{@$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}"  width="504" height="372">
                      
                        <div class="timer-subasta caption randomrotate" data-x="right" data-y="top" data-hoffset="-20" data-voffset="20" data-speed="500" data-start="100">
                            <i class="fa fa-clock-o animated infinite pulse verde r-banner" aria-hidden="true"></i>
                        </div>
                        {{--
                        <a href="#" class="like-subasta caption randomrotate rojo" data-x="right" data-y="bottom" data-hoffset="-20" data-voffset="-20" data-speed="1000" data-start="500">
                            <i class="fa fa-heart-o c-banner favorito" aria-hidden="true"></i>
                        </a>
                        --}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <section class="banner-description container afterload" style="display: none" data-slug="">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center banner-name transition-0-3">
                    <span></span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row banner-data transition-0-3">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info">
                            <span class="banner-leyenda">Puedes ofertar desde:</span>
                            <span class="banner-range"><span class="rango-min"></span> - <span class="rango-max"></span></span>
                        </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info subasta-verde">
                            <span class="subasta-tiempo countdown" start_date=""></span>
                            <span class="subasta-leyenda">Para subastar</span>
                        </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info">
                            <a class="link-subasta transition-0-3" id_producto="" href="">
                                <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Detalles</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Pruebas con bootstrap -->
    <section id="destacados" class="products-container afterload" style="display: none">
        <section class="container">
            <div class="row">
                <div class="product-container col-lg-6 col-md-6 col-sm-6 col-xs-12" data-slug="@{{lastStarted.title | slugify}}">
                    <a id_producto="@{{lastStarted.code}}" class="producto big-producto oferta-verde link-subasta no-border">
                        <div ng-show="{{$auction->isPreSaleDay()}}" class="label-preventa"></div>
                        <div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
                        <div class="img-subasta">
                            <img ng-src="@{{lastStarted.getUrlCover('now')}}" alt="" title="">
                        </div>
                        <div class="producto-nombre" >
                            @{{lastStarted.title}}
                        </div>
                        <div class="leyenda-subasta" >
                            <div>Puedes ofertar desde:</div>
                            <div class="rango-ofertas">@{{lastStarted.min_offer | currency}} - @{{lastStarted.max_offer | currency}}</div>
                        </div>
                        <div class="tiempo-producto">
                            <timer interval="1000" language="es" class="subasta-tiempo-perfil" 
                                ng-show="lastStarted.isStandBy()"
                                end-time="lastStarted.start_date"> 
                                Inicia en<br>
                                <span ng-show="days > 0">@{{days}} día<span ng-show="days > 1">s</span>,</span>
                                <span ng-show="hours > 0">@{{hours}} hr,</span>
                                <span ng-show="minutes > 0">@{{minutes}} min,</span>
                                @{{seconds}} seg
                            </timer>
                            <timer interval="1000" language="es" class="subasta-tiempo-perfil" 
                                ng-show="lastStarted.isStarted()"
                                end-time="lastStarted.end_date">
                                    Finaliza en<br>@{{hours}} hr, @{{minutes}} min, @{{seconds}} seg
                            </timer>
                            <div class="subasta-tiempo-perfil" ng-show="lastStarted.isFinished()">
                                La subasta ha terminado
                            </div>
                        </div>
                        <div class="producto-hover transition-0-3">
                            <div class="producto-titulo">@{{lastStarted.title}}</div>
                            <div class="producto-actions">
                                <div class="producto-heart"></div>
                                <span class="producto-separador"></span>
                                <div class="producto-hammer" id_producto="@{{lastStarted.code}}"></div>
                            </div>
                            <div class="producto-cover">
                                $@{{lastStarted.cover}}
                            </div>
                            <div class="leyenda-cover">
                                Tu asiento
                            </div>
                        </div>
                    </a>
                </div>
                <div class="product-container col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    @if(false)
                    <a href="{{asset('register')}}" class="producto producto-mensaje placeholder naranja">
                        <div class="img-mensaje"><img src="{{asset('img/logo-icon.png')}}" alt="Glim Glam &reg;" title="Glim Glam &reg;"></div>
                        <div class="mensaje-info">
                            <div class="mensaje-titulo">Hola</div>
                            <div class="mensaje-texto">dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </div>
                            <div class="mensaje-leyenda">¡COMENZAR YA!</div>
                            <div class="mensaje-link transition-0-3">
                                <span class="mensaje-link-icon mensaje-link-icon-registrarse transition-0-3"></span>
                                <span class="mensaje-link-texto transition-0-3">Registrate</span>
                            </div>
                        </div>
                    </a>
                    @else
                        @if(true)
                        <div class="producto producto-mensaje placeholder naranja">
                            <iframe class="video"
                                src="http://www.youtube.com/embed/JTmp1y1i-l0?rel=0"
                                frameborder="0" allowfullscreen>
                            ></iframe>
                        </div>
                        @else
                        <a id_producto="@{{lastStarted.code}}" class="producto big-producto oferta-verde link-subasta no-border">
                            <div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
                            <div class="img-subasta">
                                <img ng-src="@{{lastStarted.getUrlCover('now')}}" alt="Producto 4" title="Producto 4" style="height:300px">
                            </div>
                            <div class="producto-nombre" >
                                @{{lastStarted.title}}
                            </div>
                            <div class="leyenda-subasta" ng-show="lastStarted.last_offer">
                                <div>Ultima Oferta:</div>
                                <div class="rango-ofertas">$@{{lastStarted.last_offer}}</div>
                            </div>
                            <div class="tiempo-producto">
                                <span class="tiempo-subasta-producto countdown" start_date="@{{lastStarted.start_date}}"></span>
                                <span>Para subastar</span>
                            </div>
                            <div class="producto-hover transition-0-3">
                                <div class="producto-titulo">@{{lastStarted.title}}</div>
                                <div class="producto-actions">
                                    <div class="producto-heart"></div>
                                    <span class="producto-separador"></span>
                                    <div class="producto-hammer" id_producto="@{{lastStarted.code}}"></div>
                                </div>
                                <div class="producto-cover">
                                    @{{lastStarted.cover}}
                                </div>
                                <div class="leyenda-cover">
                                    Tu asiento
                                </div>
                            </div>
                        </a>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    </section>
    <section id="listado-home" class="products-container afterload" style="display: none">
        <section class="container-fluid">
            <div class="row">
                
            </div>
        </section>
    </section>
    <!-- FIN PRUEBAS CON BOOTSTRAP -->
</div>






<!--    -->



@stop
@section('js-scripts')
<script type="text/javascript" src="{{asset('js/estrasol/index.js')}}"></script>
@stop

