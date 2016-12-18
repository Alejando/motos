<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        @include('public.style-sheets')
        @yield('headers')
    </head>

    <body class="setpoint-public" ng-app="setpoint">
        <div class="main-conteiner">
            <header class="fontal">
                <div class="menu-top">
                    <a href="{{url("/")}}" class="sprite logo-bounce home-logo" title="Bounce Tenis Lifestyle">Home</a>
                    <nav class="menu-right">
                        <ul class="menu">
                            <li><a href="{{route('cart.list')}}" class="sprite icon-car-2" title="Mi Carrito">Mi Carrito</a></li>
                            <li><a id="btnmenuemergente" href="" class="sprite icon-menu" title="Menú">Menú</a></li>
                        </ul>

                        <ul class="menuemergente">
                            <li class="cajonicono">
                                <a class="iconocierre"></a>
                            </li>
                            @if(Auth::check())
                                <li>
                                    <a href="{{route('admin.index')}}" class="transicion">Administración</a>
                                </li>
                                <li>
                                    <a href="{{url('logout')}}" class="transicion">Salir</a>
                                </li>
                            @else
                            <li>
                                <a href="{{url('login')}}" class="transicion">Ingresar</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{url('/contacto')}}"  class="transicion">Contacto</a>
                            </li>
                            <li><a href="" class="transicion">Perfil</a></li>
                            <li><span class="separador"></span></li>
                            <li><a href="{{url('content/slug/nosotros')}}" class="transicion">Sobre nosotros</a></li>
                            <li><a href="{{url('content/slug/ventajas')}}" class="transicion">Ventajas</a></li>
                            <li><span class="separador"></span></li>
                            <!-- <li><a href="" class="transicion">Voucher</a></li> -->
                            <li><a href="{{url('content/slug/formas-de-pago')}}" class="transicion">Formas de pago</a></li>
                            <li><a href="{{url('content/slug/terminos-y-condiciones')}}" class="transicion">Condiciones de venta</a></li>
                            <li><a href="{{url('content/slug/condiciones-de-envio')}}" class="transicion">Condiciones de envío</a></li>
                            <li><a href="{{url('content/slug/condiciones-de-retorno')}}" class="transicion">Condiciones de retorno</a></li>
                            <li><a href="{{url('content/slug/aviso-de-privacidad')}}" class="transicion">Aviso de privacidad</a></li>
                            <li><span class="separador"></span></li>
                            <li><span class="txt">Número de Contacto<br /><b>01 800 000</b></span></li>
                            <li><span class="separador"></span></li>
                            <li><span class="txt">&copy; D.R. 2016</span></li>
                        </ul>
                    </nav>
                    <div style="clear: both"></div>
                </div>
                <nav>
                    @include('public.blocks.menu-lg')
                    @include('public.blocks.menu-sm')
                    <div class="search-form-2">
                        <input type="text" class="input-border" ><button class="sprite search-2"></button>
                    </div>
                    <div style="clear: both"></div>
                </nav>
                @if($showOffert)
                @include('public.blocks.offerts')
                @endif
                <div style="clear: both"></div>
            </header>
            <div class="div-main-content">
                @yield('body')
                <div style="clear: both"></div>
                @if($showBannerBottom)
                @include('public.blocks.bannerBottom')
                @endif
            </div>
            <footer>
                <div class="marcas">
                    <div id="owl-marcas" class="owl-carousel owl-theme">
                        <div class="item"><a class="sprite logo-king-of-tennis">King of tenis</a></div>
                        <div class="item"><a class="sprite logo-adidas">Adidas</a></div>
                        <div class="item"><a class="sprite logo-wilson">Wilson</a></div>
                        <div class="item"><a class="sprite logo-tennis-advisor">TennisAdvisor</a></div>
                        <div class="item"><a class="sprite logo-nike">Nike</a></div>
                        <div class="item"><a class="sprite logo-king-of-tennis">King of tenis</a></div>
                        <div class="item"><a class="sprite logo-adidas">Adidas</a></div>
                        <div class="item"><a class="sprite logo-wilson">Wilson</a></div>
                        <div class="item"><a class="sprite logo-tennis-advisor">TennisAdvisor</a></div>
                        <div class="item"><a class="sprite logo-nike">Nike</a></div>
                    </div>
                </div>
                <div class="social">
                    <section class="redes row">
                        <div  class="row cajaredes">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="cajacentermiddle">
                                            <div class="celdacentermiddle">
                                                <i class="txtright"><b>Nuestras</b><br>Redes Sociales</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="cajacentermiddle">
                                            <div class="celdacentermiddle">
                                                <div class="txtcenter">
                                                    <a href="https://twitter.com/bouncetennis/" target="_blank" class="sprite logo-twitter" title="Twitter">Twitter</a>
                                                    <a href="https://www.facebook.com/bouncetennis/" target="_blank" class="sprite logo-fb" title="Facebook">Facebook</a>
                                                    <a href="https://www.youtube.com/channel/bouncetennis/" target="_blank" class="sprite logo-youtube" title="youtube">Youtube</a>
                                                    <a href="https://www.instagram.com/bouncetennis/" target="_blank" class="sprite logo-instragram" title="Instragram">Instragram</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  class="col-sm-6">
                                <div class="row cajanewsletter">
                                    <div class="col-md-5">
                                        <div class="cajacentermiddle">
                                            <div class="celdacentermiddle">
                                                <i class="txtright"><b>Suscríbete para recibir</b><br/>nuestras promociones</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="cajacentermiddle">
                                            <div class="celdacentermiddle">
                                                <div class="contenedorfield">
                                                    <form action="//bounce.us14.list-manage.com/subscribe/post?u=0b2a08cfc6c1b1143dfc9d1be&amp;id=d9de74fb08" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                        <input type="text" class="fieldnewsletter required email" type="email" value="" name="EMAIL" id="mce-EMAIL"/>
                                                        <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="sprite icon-correo">Coreo</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="info">
                        <nav>
                            <ul class="menu row">
                                <li class="col-sm-3"><a href="{{url('/contacto')}}"><span class="sprite icon-ubicacion"></span>Contactanos</a></li>
                                <li class="col-sm-3"><a href=""><span class="sprite icon-reloj"></span>Hora de atención 9:00 a 20:00</a></li>
                                <li class="col-sm-2"><a href="{{url('content/slug/aviso-de-privacidad')}}" class="aviso">Aviso de Privacidad</a></li>
                                <li class="col-sm-4"><a class="sprite logo-bounce-2">Bounce Tennis Lifestyle</a></li>
                            </ul>
                        </nav>
                    </section>
                    <section class="metodos-pago">
                        <div class="marcas">
                            <div id="owl-metodos" class="owl-carousel owl-theme">
                                <div class="item"><a href="" class="sprite logo-visa">Visa</a></div>
                                <div class="item"><a href="" class="sprite logo-master-card">Master Card</a></div>
                                <div class="item"><a href="" class="sprite logo-paypal">PayPal</a></div>
                                <div class="item"><a href="" class="sprite logo-oxxo">Oxxo</a></div>
                                <div class="item"><a href="" class="sprite logo-seven">Seven</a></div>
                                <div class="item"><a href="" class="sprite logo-bbva">Bbva</a></div>
                                <div class="item"><a href="" class="sprite logo-scotiabank">Scotiabank</a></div>
                                <div class="item"><a href="" class="sprite logo-santander">Santander</a></div>
                            </div>
                        </div>
                    </section>
                    <section class="copyrigth">
                        <div>Copyright © BOUNCE, SA de CV. TODOS LOS DERECHOS RESERVADOS</div>
                        <div><b>©  D. R. 2016</b></div>
                    </section>
                </div>
            </footer>
        </div>
        @include('public.scripts')
    </body>
</html>

