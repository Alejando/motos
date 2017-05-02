<section class="slider_motos">
    <div id="owlSlideMotos" class="owl-carousel owl-theme">
    	@foreach(\DwSetpoint\Models\Product::where('favorite',1)->get() as $key=>$product)
    		<div class="item">
	            <div class="content_img">
	            	<figure class="slider_img">
	            		<img src="{{ asset('img/motos/moto1.png') }}">
	            	</figure>
		        </div>
		         <div class="content_text ">
		         	<div class="ktm_container">
		         		<h2 class="ktm_white">{{$product->name}}</h2>
		         		<p class="ktm_white_light">
		         			{{$product->description}}
		         		</p>
						<div class=" ">
			         		@foreach($product->features as $key => $feature)
			         			@if($feature->type->name=="Principales")
			         				<h5 class="star ktm_white">{{$feature->value}}</h5>
			         			@endif
			         		@endforeach
						</div>

		         		
		         		<div class="">
		         			<a href="" class="link_white">Ver detalles</a>
		         		</div>
		         		
		         	</div>
	            	
		        </div>
	        </div> 
	    @endforeach
        
    </div>
    
</section>