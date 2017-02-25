<section class="slider_principal">
    <div id="owlSliderPrincipal" class="owl-carousel owl-theme">
    	@for($i=0;$i<4;$i++)
    		<div class="item">
	            <div class="slider_content">
	            	<figure class="slider_img">
	            		<img src="{{ asset('img/motos/KTMM_slider-img.jpg') }}">
	            	</figure>
	            	 <div class="slider_content_text">
		            	<h3 class="ktm_orange">Subtitulo del slider</h3>
		            	<h2 class="ktm_white ">Texto de introducción para cada slide del carrusel </h2>
						<a href ="" class="ktm_btn_primary ktm_shadon_5">Más información</a>
		            </div>
		        </div>
	        </div> 
	    @endfor
        
    </div>
    
</section>

