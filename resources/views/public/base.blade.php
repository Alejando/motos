<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        @include('public.style-sheets')
    </head>
    
    <body class="setpoint-public">
        <div class="main-conteiner">
            <header class="fontal" style="display: none_ ">
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
                    <ul class="menumain">
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
            </div>
            <footer> 
            @if($showBannerBottom)
                @include('public.blocks.bannerBottom')
            @endif
            <div class="marcas">
                <ul class="menu">
                    <li><a class="sprite logo-king-of-tennis">King of tenis</a></li>
                    <li><a  class="sprite logo-adidas">Adidas</a></li>
                    <li><a  class="sprite logo-wilson">Wilson</a></li>
                    <li><a  class="sprite logo-tennis-advisor">TennisAdvisor</a></li>
                    <li><a  class="sprite logo-nike">Nike</a></li>
                </ul>
            </div>
            <div class="social">
                <section class="redes row" style=" margin: 0; padding: 0 ">
                    <div  class="row" style="border-bottom: #e1eaa3 2px solid; margin: 0; padding: 0 ">
                        <div class="col-sm-6" style="padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
                            <div class="col-sm-4 text-right" style="padding: 15px 2px 10px 2px"><i><b>Nuestras</b> <br>Redes Sociales</i></div>
                            <div class="col-sm-8">
                                <ul class="menu">
                                <li><a href="" class="sprite logo-twitter" title="Twitter">Twitter</a></li>
                                <li><a href="" class="sprite logo-fb" title="Facebook">Facebook</a></li>
                                <li><a href="" class="sprite logo-youtube" title="youtube">Youtube</a></li>
                                <li><a href="" class="sprite logo-instragram" title="Instragram">Instragram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div  class="col-sm-6" style="
                              background-color: #c1d72e; 
                              position: relative;  
                              top: 0;
                              font-size: 18px;
                              font-family: 'Open Sans' !important;
                              padding: 25px 0 25px 0;
                              ">
                                <div class="col-sm-5">
                                    <i><b>Suscribete para recibir</b><br/>
                                        nuestras promociones</i>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" style="
                                           font-size: 15px;
                                           height: 34px;
                                           padding: 5px;
                                           position: relative; top: 10px; border-radius: 5px; border-style: none; color:black" />
                                    <button class="sprite icon-correo">Coreo</button>
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
                    <nav>
                        <ul class="menu">
                            <li><a href="" class="sprite logo-visa">Visa</a></li>
                            <li><a href="" class="sprite logo-master-card">Master Card</a></li>
                            <li><a href="" class="sprite logo-paypal">PayPal</a></li>
                            <li><a href="" class="sprite logo-oxxo">Oxxo</a></li>
                            <li><a href="" class="sprite logo-seven">Seven</a></li>
                            <li><a href="" class="sprite logo-bbva">Bbva</a></li>
                            <li><a href="" class="sprite logo-scotiabank">Scotiabank</a></li>
                            <li><a href="" class="sprite logo-santander">Santander</a></li>
                        </ul>
                    </nav>
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