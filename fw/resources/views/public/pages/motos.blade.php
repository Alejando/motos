@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="motos">
    	<div class="motos_filter">
	    </div>
	    @for($i=0;$i<4;$i++)
	    	@if($i%2==0)
		    	<div class="motos_content_2">
		    @else
		    	<div class="group motos_content_1">
		    @endif
		    	<a href="">
			    	<div class="img_background">
				    	<figure class="img_content">
				    		<img src="img/motos/moto1.png" alt="Moto">
				    	</figure>
			    	</div>
			    	<div class="text_background">
			    		<div class="text_content">
			    			<h2 class="ktm_orange">450 SX-F FACTORY EDITION</h2>
				    		<h5 class="ktm_gray_middle">NARANJA / BLANCO</h5>
				    		<h3 class="ktm_orange">FUNCIONES PRINCIPALES</h3>
				    		@for($j=0;$j<4;$j++)
				    			<p class="feacture ktm_black"> <strong>TRANSMISIÓN: </strong></p>
				    			<P class="feacture_description ktm_gray_dark" >5 VELOCIDADES</P>
				    		@endfor
			    		</div>
			    	</div>
			   	</a>
			   	<div class="motos_share">
			    	<a href="" class="ktm_btn_primary">
						<img src="img/svg/share.svg" alt="Compartir Moto">
					</a>
			    </div>
		    </div>
	    @endfor
    </section>

 @stop