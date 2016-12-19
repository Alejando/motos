<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        <?php echo $__env->make('public.style-sheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('headers'); ?>
    </head>
    
    <body class="setpoint-public">
        <div class="main-conteiner">
            <header class="fontal">
                <div class="menu-top">
                    <a href="<?php echo e(url("/")); ?>" class="sprite logo-bounce home-logo" title="Bounce Tenis Lifestyle">Home</a>
                    <nav class="menu-right">
                        <ul class="menu">
                            <li><a href="./carrito" class="sprite icon-car-2" title="Mi Carrito">Mi Carrito</a></li>
                            <li><a id="btnmenuemergente" href="" class="sprite icon-menu" title="Menú">Menú</a></li>
                        </ul>

                        <ul class="menuemergente">
                            <li class="cajonicono">
                                <a class="iconocierre"></a>
                            </li>
                            <?php if(Auth::check()): ?>
                                <li>
                                    <a href="<?php echo e(route('admin.index')); ?>" class="transicion">Administración</a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?php echo e(url('login')); ?>" class="transicion">Ingresar</a>
                                </li>
                            <?php endif; ?>
                            <li>
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
                    <?php echo $__env->make('public.blocks.menu-lg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('public.blocks.menu-sm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="search-form-2">
                        <input type="text" class="input-border" ><button class="sprite search-2"></button>
                    </div>
                    <div style="clear: both"></div>
                </nav>
                <?php if($showOffert): ?>
                    <?php echo $__env->make('public.blocks.offerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <div style="clear: both"></div>
            </header>
            <div class="div-main-content"> 
                <?php echo $__env->yieldContent('body'); ?>
                <div style="clear: both"></div>
                <?php if($showBannerBottom): ?>
                    <?php echo $__env->make('public.blocks.bannerBottom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
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
                            <li class="col-sm-3"><a href="<?php echo e(url('/direccion')); ?>"><span class="sprite icon-ubicacion"></span>Dirección</a></li>
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
        <?php echo $__env->make('public.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>