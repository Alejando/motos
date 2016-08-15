@extends('public.base')
@section('body')
<div ng-controller="public.IndexCtrl">
    <section class="fancy-producto">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-1 text-center">
                <div class="producto-fancy">
                    <div class="recorte-superior"></div>
                    <div class="producto-fancy-cover">
                        <span class="precio-cover"> $ 0000.00</span>
                        <span>Cover</span>
                    </div>
                    <div id="img-principal" class="producto-fancy-img">
                        <img id="zoom_mw" src="img/productos/producto02.png" data-zoom-image="img/productos/producto02.png" alt="" title="">
                    </div>
                    <div class="producto-fancy-img-galeria">
                        <div class="col-xs-4 nopadding">
                            <div class="frame-galeria gal-1">
                                <img src="img/productos/producto02.png" alt="" title="">
                            </div>
                        </div>
                        <div class="col-xs-4 nopadding">
                            <div class="frame-galeria gal-2">
                                <img src="img/productos/producto02a.png" alt="" title="">
                            </div>
                        </div>
                        <div class="col-xs-4 nopadding">
                            <div class="frame-galeria gal-3">
                                <img src="img/productos/producto02b.png" alt="" title="">
                            </div>
                        </div>
                        <!-- <div class="col-xs-4 nopadding">
                                <div class="frame-galeria">
                                        <img src="img/productos/producto02.png" alt="" title="">
                                </div>
                        </div>
                        <div class="col-xs-4 nopadding">
                                <div class="frame-galeria">
                                        <img src="img/productos/producto02.png" alt="" title="">
                                </div>
                        </div>
                        <div class="col-xs-4 nopadding">
                                <div class="frame-galeria">
                                        <img src="img/productos/producto02.png" alt="" title="">
                                </div>
                        </div> -->
                    </div>
                    <div class="recorte-inferior"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 text-center">
                <div class="descripcion-fancy">
                    <div class="fancy-titulo">CARTIER ARISTÓCRATA 2017</div>
                    <div class="leyenda-subasta">
                        <div>Puedes subastar desde:</div>
                        <div class="rango-ofertas">$0000.00 - $0000.00</div>
                    </div>
                    <div class="btns-descripcion"></div>
                    <div class="fancy-txt">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates obcaecati excepturi accusantium voluptas odio eligendi deleniti magni, enim blanditiis magnam dolores praesentium perspiciatis velit. Unde inventore recusandae odit ullam quia!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates obcaecati excepturi accusantium voluptas odio eligendi deleniti magni, enim blanditiis magnam dolores praesentium perspiciatis velit. Unde inventore recusandae odit ullam quia!</p>
                    </div>
                    <div class="producto-boton-entrar">
                        <a class="link-subasta transition-0-3" href="">
                            <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slideshow container-fluid" style="display: none">
        <div class="banner-container">
            <div class="banner" >
                <ul class="banner-list">
                    <!-- THE BOXSLIDE EFFECT EXAMPLES  WITH LINK ON THE MAIN SLIDE EXAMPLE --> 
                    @foreach($sliderAuctions as $auction)
                    <li data-transition="fade" data-masterspeed="700" 
                        data-slotamount="8" 
                        id-producto="{{$auction->code}}" 
                        product-name="{{$auction->title}}" 
                        rangomin="{{currency($auction->min_offer, config('app.currency'))}}" 
                        rangomax="{{Currency::format($auction->max_price, config('app.currency'))}}" 
                        expiration="{{$auction->start_date}}">
                        <img src="{{@$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}"  width="504" height="372">
                        <div class="timer-subasta caption randomrotate" data-x="right" data-y="top" data-hoffset="-20" data-voffset="20" data-speed="1000" data-start="500">
                            <i class="fa fa-clock-o animated infinite pulse verde r-banner" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="like-subasta caption randomrotate rojo" data-x="right" data-y="bottom" data-hoffset="-20" data-voffset="-20" data-speed="1000" data-start="500">
                            <i class="fa fa-heart-o c-banner favorito" aria-hidden="true"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <section class="banner-description container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center banner-name transition-0-3">
                    - <span></span> -
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row banner-data transition-0-3">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info">
                            <span class="banner-leyenda">Puedes subastar desde:</span>
                            <span class="banner-range"><span class="rango-min"></span> - <span class="rango-max"></span></span>
                        </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info subasta-verde">
                            <span class="subasta-tiempo countdown" expiration=""></span>
                            <span class="subasta-leyenda">Para subastar</span>
                        </div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center vcenter banner-info">
                            <a class="link-subasta transition-0-3" href="#fancy-subasta">
                                <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Pruebas con bootstrap -->
    <section id="destacados" class="products-container">
        <section class="container">
            <div class="row">
                    <div class="product-container col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a id_producto="001" class="producto big-producto oferta-verde" >
				<div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
				<div class="img-subasta">
                                    <img src="@{{lastStarted.getUrlCover('now')}}" alt="Producto 4" title="Producto 4" style="height:300px">
				</div>
                                <div class="producto-nombre" >
					- @{{lastStarted.title}} -
				</div>
				<div class="leyenda-subasta">
					<div>Ultima Oferta:</div>
					<div class="rango-ofertas">$- @{{lastStarted.last_offer}} -</div>
				</div>
				<div class="tiempo-producto">
					<span class="tiempo-subasta-producto countdown" expiration="2016-03-14T20:12:00"></span>
					<span>Para subastar</span>
				</div>
				<div class="producto-hover transition-0-3">
					<div class="producto-titulo">Titulo de producto</div>
					<div class="producto-actions">
						<div class="producto-heart"></div>
						<span class="producto-separador"></span>
						<div class="producto-hammer" id_producto="001"></div>
					</div>
					<div class="producto-cover">
						$0,000.00
					</div>
					<div class="leyenda-cover">
						COVER
					</div>
				</div>
			</a>
		</div>
		<div class="product-container col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a href="registro" class="producto producto-mensaje placeholder naranja">
				<div class="img-mensaje"><img src="img/logo-icon.png" alt="Glim Glam &reg;" title="Glim Glam &reg;"></div>
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
		</div>
            </div>
        </section>
    </section>
    <section id="listado-home" class="products-container">
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

