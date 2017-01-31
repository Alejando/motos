<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        @include('public.style-sheets')
        <script type="text/javascript">
            @if(Auth::user())
                var user = {!!Auth::user()->toJSON()!!}; 
            @endif
        </script>
        @yield('headers')
        <!--Start of Zendesk Chat Script-->
        <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="https://v2.zopim.com/?4AFML9HAB3twafcaCxwoyvHuxlRKb6jX";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        </script>
        <!--End of Zendesk Chat Script-->
    </head>
    <body class="setpoint-public" ng-app="setpoint">
        <div class="main-conteiner">
            <header class="fontal">
                <div class="menu-top">
                    <a href="{{url("/")}}" class="logo-bounce home-logo" title="Bounce Tenis Lifestyle"><img src="{{asset('/css/logo-bounce.svg')}}"/></a>
                    <nav class="menu-right">
                        <ul class="menu">
                            <div class="dropdown-cart" ng-controller="CartListItemCtrl">
                                <li><a href="{{route('cart.list')}}" class="sprite icon-car-2" title="Mi Carrito">Mi Carrito</a></li>
                                <span ng-show="items.length > 0" ng-cloak>
                                    <strong class="cart_number">@{{items.length}}</strong>
                                </span>
                              <div class="dropdown-content-cart" ng-cloak>
                                <ul class="list-cart" ng-repeat="item in items" >
                                  <li>
                                      <span class="item">
                                        <span class="item-left">
                                            <img class="item_img" ng-src="@{{item.product.getURLCover()}}" alt="" />
                                            <span class="item-info">
                                                <span><b>@{{item.product.name}}</b></span>
                                                <div  class="item_price">
                                                    @{{item.getSubTotal()|currency}} &nbsp;<span class="item_quantity" ng-show="item._quantity > 1"> x @{{item._quantity}}</span>
                                                </div>
                                            </span>
                                        </span>
                                        <!-- <span class="item-right">
                                            <button ng-click="removeItem(item)" class="btn_delete pull-right">X</button>
                                        </span> -->
                                    </span>
                                  </li>
                                </ul>
                                <div class="row list_subtotal" ng-show="cart.getSubTotal() > 0">
                                    <div class="col-sm-6"><b>Subtotal:</b></div>
                                    <div class="col-sm-6 pull-right">@{{cart.getSubTotal()|currency}}MXP</div> 
                                </div>
                              </div>
                            </div>
                            <li><a id="btnmenuemergente" href="" class="sprite icon-menu" title="Menú">Menú</a></li>
                        </ul>
                        
                        <ul class="menuemergente">
                            <li class="cajonicono">
                                
                                <a class="iconocierre"></a>
                            </li>
                            @if(Auth::check())
                                
                                <li><a href="" class="transicion">Cuenta ({{Auth::user()->email}})</a></li>
                                <li><span class="separador"></span></li>
                                @if(Auth::user()->isAdmin())
                                <li>
                                    <a href="{{route('admin.index')}}" class="transicion">Administración</a>
                                </li>
                                @endif
                                @if(Auth::user()->isClient())
                                    <li><a href="{{route('user.profile')}}" class="transicion">Mi perfil</a></li>
                                    <li><a href="{{route('user.getOrders')}}" class="transicion">Mis pedidos</a></li>
                                    <li><a href="{{route('user.getAddresses')}}" class="transicion">Mis direcciones</a></li>
                                    
                                @endif
                                <li>
                                    <a href="{{url('logout')}}" class="transicion">Salir</a>
                                </li>
                            @else
                            <li>
                                <a href="{{url('login')}}" class="transicion">Ingresar</a>
                            </li>
                            @endif
    
                            
                            <li><span class="separador"></span></li>
                            <li><a href="{{route('Content.slug',['slug'=>'nosotros'])}}" class="transicion">Sobre nosotros</a></li>
                            <li><a href="{{route('Content.slug',['slug'=>'preguntas-frecuentes'])}}" class="transicion">Preguntas frecuentes</a></li>
                            <li><a href="{{route('Content.slug',['slug'=>'aviso-de-privacidad'])}}" class="transicion">Aviso de privacidad</a></li>
                            <li><span class="separador"></span></li>
                            <!-- <li><a href="" class="transicion">Voucher</a></li> -->
                            <!-- <li><a href="{{route('Content.slug',['slug'=>'formas-de-pago'])}}" class="transicion">Formas de pago</a></li>
                            <li><a href="{{route('Content.slug',['slug'=>'terminos-y-condiciones'])}}" class="transicion">Condiciones de venta</a></li>
                            <li><a href="{{route('Content.slug',['slug'=>'condiciones-de-envio'])}}" class="transicion">Condiciones de envío</a></li>
                            <li><a href="{{route('Content.slug',['slug'=>'condiciones-de-retorno'])}}" class="transicion">Condiciones de retorno</a></li> -->
                            <li><a href="{{url('/contacto')}}"  class="transicion">Contacto</a></li>
                            <li><span class="separador"></span></li>
                            <li><span class="txt">Número de Contacto<br /><b>(33) 3336 7487 </b></span></li>
                            <li><span class="separador"></span></li>
                            <li><span class="txt">&copy; D.R. 2016</span></li>
                        </ul>
                    </nav>
                    <div style="clear: both"></div>
                </div>
                <div>
                <!--{{-- @if($menuUser)
                    <ul class="menumain hidden-sm hidden-xs">
                        <li><a href="" class="transicion">PERFIL</a></li>
                        <li><a href="" class="transicion">PEDIDOS</a></li>
                        <li><a href="" class="transicion">DIRECCIONES</a></li>
                    </ul>
                @else --}} -->
                    @include('public.blocks.menu-lg')
                    @include('public.blocks.menu-sm')
                <!--{{-- @endif --}}-->
                
                <div class="search-form-2">
                    <form class="row" action="{{ url('busqueda/personalizada/') }}" method="POST">
                       
                        <input type="text" class="input-border col-md-8" name="search">
                        <button class="sprite search-2 col-md-4" type="submit"></button> 
                     
                        
                    </form>
                </div>
               
                    <div style="clear: both"></div>
                </div>
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
                @include('public.blocks.bannerBrands')
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
                                                    <!-- <a href="{{Config('app.social.twitter')}}" target="_blank" class="sprite logo-twitter" title="Twitter">Twitter</a> -->
                                                    <a href="{{DwSetpoint\Models\DBConfig::getUrlFacebook()}}" target="_blank" class="sprite logo-fb" title="Facebook">Facebook</a>
                                                    <!-- <a href="{{Config('app.social.youtube')}}" target="_blank" class="sprite logo-youtube" title="youtube">Youtube</a> -->
                                                    <a href="{{DwSetpoint\Models\DBConfig::getUrlInstragram()}}" target="_blank" class="sprite logo-instragram" title="Instragram">Instragram</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  class="col-sm-6">
                                <div class="row cajanewsletter">
                                    <div class="col-md-12">
                                        <div class="cajamiddle_newsletter">
                                            <i class="txtcenter"><b>Suscríbete para recibir nuestras promociones</b></i> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="cajamiddle_newsletter txtcenter">
                                            <form action="//bounce.us14.list-manage.com/subscribe/post?u=0b2a08cfc6c1b1143dfc9d1be&amp;id=d9de74fb08" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
                                                    <input type="text" class="fieldnewsletter required email" type="email" value="" name="EMAIL" id="mce-EMAIL"/>
                                                    <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="sprite icon-correo">Coreo</button>
                                                </div>
                                            </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="info">
                        <nav>
                            <ul class="menu row">
                                <li class="col-sm-3"><a href="{{url('/contacto')}}"><span class="sprite icon-ubicacion"></span>Contáctanos</a></li>
                                <li class="col-sm-3">
                                    <a href="">
                                        <span class="sprite icon-reloj"></span>{{DwSetpoint\Models\DBConfig::getSchedule()}}</a></li>
                                <li class="col-sm-2"><a href="{{route('Content.slug',['slug'=>'aviso-de-privacidad'])}}" class="aviso">Aviso de Privacidad</a></li>
                                <li class="col-sm-4"><a class="logo-bounce-2"><img src="{{asset('/css/logo-bounce-invert.svg')}}"/></a></li>
                            </ul>
                        </nav>
                    </section>
                    <section class="metodos-pago">
                        <div class="metodos">
                            <div id="owl-metodos" class="owl-carousel owl-theme">
                                <div class="item"><a href="" class="sprite logo-visa">Visa</a></div>
                                <div class="item"><a href="" class="sprite logo-master-card">Master Card</a></div>
                                <div class="item"><a href="" class="sprite logo-paypal">PayPal</a></div>
                                <div class="item"><a href="" class="sprite logo-oxxo">Oxxo</a></div>
                                <div class="item"><a href="" class="sprite logo-seven">Seven</a></div>
                                <div class="item"><a href="" class="sprite logo-visa">Visa</a></div>
                                <div class="item"><a href="" class="sprite logo-master-card">Master Card</a></div>
                                <div class="item"><a href="" class="sprite logo-paypal">PayPal</a></div>
                                <div class="item"><a href="" class="sprite logo-oxxo">Oxxo</a></div>
                                <div class="item"><a href="" class="sprite logo-seven">Seven</a></div>
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


