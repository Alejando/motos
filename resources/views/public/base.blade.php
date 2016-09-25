<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        @include('public.style-sheets')
    </head>
    
    <body class="setpoint-public">
        <div class="main-conteiner">
            <header class="fontal">
                <div class="menu-top">
                    <a href="#" class="sprite logo-bounce home-logo" title="Bounce Tenis Lifestyle">Home</a>
                    <nav class="menu-right">
                        <ul class="menu">
                            <li><a href="./carrito" class="sprite icon-car-2" title="Mi Carrito">Mi Carrito</a></li>
                            <li><a id="btnmenuemergente" href="" class="sprite icon-menu" title="Menú">Menú</a></li>
                        </ul>

                        <ul class="menuemergente">
                            <li class="cajonicono">
                                <a class="iconocierre"></a>
                                <a href="" class="transicion">Contacto</a>
                            </li>
                            <li><a href="" class="transicion">Perfil</a></li>
                            <li><span class="separador"></span></li>
                            <li><a href="" class="transicion">Sobre nosotros</a></li>
                            <li><a href="" class="transicion">Ventajas</a></li>
                            <li><span class="separador"></span></li>
                            <li><a href="" class="transicion">Voucher</a></li>
                            <li><a href="" class="transicion">Formas de pago</a></li>
                            <li><a href="" class="transicion">Condiciones de venta</a></li>
                            <li><a href="" class="transicion">Condiciones de envío</a></li>
                            <li><a href="" class="transicion">Condiciones de retorno</a></li>
                            <li><a href="" class="transicion">Protección de datos</a></li>
                            <li><span class="separador"></span></li>
                            <li><span class="txt">Número de Contacto<br /><b>01 800 000</b></span></li>
                            <li><span class="separador"></span></li>
                            <li><span class="txt">&copy; D.R. 2016</span></li>
                        </ul>
                    </nav>
                    <div style="clear: both"></div>
                </div>
                <nav>
                    <ul class="menumain hidden-sm hidden-xs">
                        <li>
                            <a href="" class="transicion">DAMA</a>
                            <div class="cajasubmenu">
                                <div class="row lineaencabezado">
                                    <div class="col-md-6">
                                        <h3><span>Marcas</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3><span>Ropa</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <ul>
                                            <li><a href="">Nike</a></li>
                                            <li><a href="">Adidas</a></li>
                                            <li><a href="">Wilson</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li><a href="">Blusas</a></li>
                                            <li><a href="">Chamarras</a></li>
                                            <li><a href="">Faldas</a></li>
                                            <li><a href="">Gorras</a></li>
                                            <li><a href="">Ropa interior</a></li>
                                            <li><a href="">Shorts</a></li>
                                            <li><a href="">Vestidos</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="" class="transicion">CABALLERO</a></li>
                        <li><a href="" class="transicion">ZAPATOS</a></li>
                        <li><a href="" class="transicion">RAQUETAS</a></li>
                        <li><a href="" class="transicion">BOLSAS</a></li>
                        <li><a href="" class="transicion">PELOTAS</a></li>
                        <li><a href="" class="transicion">OTROS</a></li>
                        <li><a href="" class="transicion">DESCUENTOS</a></li>
                    </ul>

                    <div class="cajamenumovil hidden-md hidden-lg">
                        <a class="btncatalogo transicion"><i class="fa fa-bars"></i> <span>CATEGORÍAS</span></a>
                        <div class="menumainmovil">
                            <div class="cajacerrar"><a class="btncerrar transicion"><i class="fa fa-close"></i></a></div>
                            <a href="" data-btnsub="dama" class="transicion">DAMA <i class="fa fa-angle-right pull-right"></i></a>
                            <div data-mnusub="dama" class="submenumovil">
                                <div class="cajacerrar transicion"><a class="btncerrar"><i class="fa fa-close"></i></a></div>
                                <h3><span>Marcas</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                                <a href="" class="transicion">Nike</a>
                                <a href="" class="transicion">Adidas</a>
                                <a href="" class="transicion">Wilson</a>
                                <h3><span>Ropa</span> <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
                                <a href="" class="transicion">Blusas</a>
                                <a href="" class="transicion">Chamarras</a>
                                <a href="" class="transicion">Faldas</a>
                                <a href="" class="transicion">Gorras</a>
                                <a href="" class="transicion">Ropa interior</a>
                                <a href="" class="transicion">Shorts</a>
                                <a href="" class="transicion">Vestidos</a>
                            </div>
                            <a href="" data-btnsub="" class="transicion">CABALLERO</a>
                            <a href="" data-btnsub="" class="transicion">ZAPATOS</a>
                            <a href="" data-btnsub="" class="transicion">RAQUETAS</a>
                            <a href="" data-btnsub="" class="transicion">BOLSAS</a>
                            <a href="" data-btnsub="" class="transicion">PELOTAS</a>
                            <a href="" data-btnsub="" class="transicion">OTROS</a>
                            <a href="" data-btnsub="" class="transicion">DESCUENTOS</a>
                        </div>
                    </div>

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
                                                <a href="" class="sprite logo-twitter" title="Twitter">Twitter</a>
                                                <a href="" class="sprite logo-fb" title="Facebook">Facebook</a>
                                                <a href="" class="sprite logo-youtube" title="youtube">Youtube</a>
                                                <a href="" class="sprite logo-instragram" title="Instragram">Instragram</a>
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
                                            <i class="txtright"><b>Suscribete para recibir</b><br/>nuestras promociones</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="cajacentermiddle">
                                        <div class="celdacentermiddle">
                                            <div class="contenedorfield">
                                                <input type="text" class="fieldnewsletter" />
                                                <button class="sprite icon-correo">Coreo</button>
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
                            <li class="col-sm-3"><a href=""><span class="sprite icon-ubicacion"></span>Dirección</a></li>
                            <li class="col-sm-3"><a href=""><span class="sprite icon-reloj"></span>Hora de atención 00:00 a 00:00</a></li>
                            <li class="col-sm-2"><a href="" class="aviso">Aviso Legal</a></li>
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