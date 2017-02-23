<section class="slider_motos">
    <div id="owlSlideMotos" class="owl-carousel owl-theme">
    	@for($i=0;$i<4;$i++)
    		<div class="item">
	            <div class="content_img">
	            	<figure class="slider_img">
	            		<img src="{{ asset('img/motos/moto1.png') }}">
	            	</figure>
		        </div>
		         <div class="content_text ">
		         	<div class="ktm_container">
		         		<h2 class="ktm_white">690 ENDURO R</h2>
		         		<p class="ktm_white_light">
		         			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non tellus id metus ultrices facilisis. Fusce ut metus quis nibh tempor lacinia et sit amet risus. Aliquam sit amet sem pulvinar, faucibus risus non, feugiat nunc. Nunc malesuada nunc a justo fermentum, eget posuere justo auctor. Praesent sed consequat mauris, in luctus magna. Sed dui lacus, vehicula et libero et, semper egestas ante. Quisque id condimentum lorem.
		         		</p>
		         		<div class=" ">
		         			<h5 class="star ktm_white">Dato destacado 1</h5>
		         			<h5 class="star ktm_white">Dato destacado 2</h5>
		         		</div>
		         		<div class=" ktm_visibility">
		         			<h5 class="star ktm_white ">Dato destacado 3</h5>
		         			<h5 class="star ktm_white ">Dato destacado 4</h5>
		         		</div>
		         		<div class="">
		         			<a href="" class="link_white">Ver detalles</a>
		         		</div>
		         		
		         	</div>
	            	
		        </div>
	        </div> 
	    @endfor
        
    </div>
    
</section>