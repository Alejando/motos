@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="news ">
    	<div class="label_category ">
    		<ul class="ktm_container">
                <li>CATEGORIAS:</li>
        		@for($i=0;$i<4;$i++)
    				<li><a href=""><h4 class="ktm_gray_middle">Categoria</h4></a></li>
        		@endfor
            </ul>
    	</div>
        {{-- Inicia Noticias Populares --}}
        <div class="popular_news news_col_1">
            @for($i=1;$i<4;$i++)
                <div class="popular_content news_element{{ $i }}">
                    <div  class="popular_img">
                        <figure>
                            <img src="img/news/news{{ $i }}.jpg">
                        </figure>
                    </div>
                    <div  class="popular_text">
                        <a href="" class="link_white">
                            <h5 class="ktm_orange">Actualidad</h5>
                            <h4  class="ktm_black">Federación exige el endurecimiento de las penas en accidentes con ciclistas que noutilizan equipo de protección.</h4>
                        </a>
                    </div>
                </div>
            @endfor
        </div>
        {{-- Termina Noticias Populares --}}
        {{-- Inicia Noticias Destacadas --}}
	   	<div class="outstanding_news news_col_1">
	   		<div> 
                <hr class="line_title">
                <h3>NOTICIAS DESTACADAS</h3>
               
            </div>
            @for($i=1;$i<=3;$i++)
                <div class="outstanding_content news_element{{ $i }}"> 
                    <div class="outstanding_img">
                        <figure>
                            <img src="img/news/news{{ $i }}.jpg">
                        </figure>
                    </div>
                    <div class="outstanding_text">
                        <a href="" class="link_white">
                            <p class="ktm_banner_orange"> Evento</p>
                            <h3 class="ktm_white">Presentación del Libro: 50 Years KTM Brand Bikes</h3>
                            <h5 class="ktm_white_light">Ocubre 12, 2016</h5>
                        </a>
                    </div> 
                </div>
            @endfor
	   	</div>
        {{-- Termina  Noticias Destacadas --}}
        {{-- Inicia Noticias Recientes --}}
        <div class="breaking_news news_col_2">
            <div>
                <hr class="line_title">
                <h3>NOTICIAS RECIENTES</h3>
            </div>
             @for($i=1;$i<=2;$i++)
                <div class="breaking_content">
                    <div class="breaking_title">
                        <h3 class="ktm_orange">RUTAS CICLISMO EN GUADALAJARA ESTADO DE JALISCO (MÉXICO)</h3>
                    </div>
               
                    <div class="breaking_info">
                        <p class="ktm_banner_orange">Actualiad</p>
                        <p class="ktm_gray_middle"> | </p>
                        <p class="ktm_black"> POR: <u>KTM MOTOS</u></p>
                        <p class="ktm_gray_middle"> HACE 1 HORA </p>
                        <p class="ktm_gray_middle"> | </p>
                        <p class="ktm_gray_middle"><span class="fa fa-comments"></span> 3 </p>
                        <p class="ktm_gray_middle"><span class="fa fa-share-alt"></span> 12 </p>
                    </div>
                    <div class="breaking_img">
                         <figure>
                            <img src="img/news/news{{ $i }}.jpg">
                        </figure>
                    </div>
                    <div class="breaking_text">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate ligula dui, ac porta nunc elementum eu. Fusce in vulputate nulla. Donec ut felis tempor, tempor leo eu, vestibulum enim. Maecenas nisi felis, vehicula ultrices fringilla eget, dapibus in dui. Integer eu ultrices sapien. Nam molestie libero nibh, sit amet dictum ex ornare ut. Cras tempor varius rhoncus. In porta nec enim at efficitur.
                        </p>
                        <a href="" class="link_orange">Continuar leyendo...</a>
                    </div> 
                </div>
            @endfor
        </div>
        {{-- Termina Noticias Recientes --}}
        <div class="news_col_3">
            {{--  Inicia SObre KTM --}}
            <div class="about_ktm ">
                <div>
                    <hr class="line_title">
                    <h3>SOBRE KTM MOTOS</h3>
                </div>
                <div class="about_ktm_content ktm_center">
                     <figure>
                         <img src="img/logo-naranja-negro-ktm-gdl.svg" alt="">
                     </figure>
                     <p>
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate ligula dui, ac porta nunc elementum eu. Fusce in vulputate nulla. Donec ut felis tempor, tempor leo eu, vestibulum enim. Maecenas nisi felis, vehicula ultrices fringilla eget, dapibus in dui. Integer eu ultrices sapien. Nam molestie libero nibh, sit amet dictum ex ornare ut. Cras tempor varius rhoncus. In porta nec enim at efficitur.
                     </p>
                     <a href ="" class="link_orange">leer más...</a>
                </div>
            </div>
             {{--  Termina SObre KTM --}}
             {{-- Inicia Newsletter ktm motos --}}
            <div class="newsletter_news">
                <div>
                    <hr class="line_title">
                    <h3>NEWSLETTER KTM MOTOS</h3>
                </div>
                <div class="newsletter_content">
                    <div class="newsletter_img">
                         <figure>
                            <img src="img/news/news5.jpg">
                        </figure>
                    </div>
                    <div class="newsletter_text ktm_center">
                        <h4 class="ktm_white">¿QUIERES MANTENERTE INFORMADO SOBRE LOS NEICOS PRODUCTOS Y PROMOCIONES Y EVENTOS DE KTM MOTOS?</h4>
                        <h4 class="ktm_white">SUSCRIBETE A NUESTRO NEWSLETTER</h4>
                        <form>
                            <div class="input-group">
                                <input type="text" name="correo" class="form-control form_newletter" >
                                <span class="input-group-btn">
                                    <input type="submit" value="Suscribirme" class="btn btn-primary form_newletter" >
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Termina Newsletter ktm motos --}}
        </div>
        {{-- Inicia  Categorias  --}}
        <div class="category_news news_col_3">
            <div>
                <div>
                    <hr class="line_title">
                    <h3>Eventos</h3>
                </div>
                @for($i=1;$i<=3;$i++)
                    <div class="category_news_content"> 
                        <div class="category_news_img">
                            <figure>
                                <img src="img/news/news{{ $i }}.jpg">
                            </figure>
                        </div>
                        <div class="category_news_text">
                            <a href="" class="link_white">
                                <h3 class="ktm_white">Presentación del Libro: 50 Years KTM Brand Bikes</h3>
                                <h5 class="ktm_white_light">Ocubre 12, 2016</h5>
                            </a>    
                        </div> 
                    </div>
                @endfor
            </div>
        </div>
        {{-- Termina  Categorias  --}}
        {{-- Inicia Noticias Populares --}}
        <div class="popular_news news_col_1">
            <div>
                <hr class="line_title">
                <h3>NOTICIAS POPULARES</h3>
            </div>
            @for($i=1;$i<4;$i++)
                <div class="popular_content news_element{{ $i }}">
                    <div  class="popular_img">
                        <figure>
                            <img src="img/news/news{{ $i }}.jpg">
                        </figure>
                    </div>
                     <div  class="popular_text">
                        <a href="">
                            <h5 class="ktm_orange">Actualidad</h5>
                            <h4 class="ktm_black">Federación exige el endurecimiento de las penas en accidentes con ciclistas que noutilizan equipo de protección.</h4>
                        </a>
                    </div>
                </div>
            @endfor
             <a href ="" class="link_orange "> Ver más noticias...</a>
        </div>
        {{-- Termina Noticias Populares --}}
    </section>

 @stop