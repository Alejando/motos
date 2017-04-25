
<section class="slider_principal">
    <div id="owlSliderPrincipal" class="owl-carousel owl-theme">
    	@foreach(\DwSetpoint\Models\Slider::find(1)->items as $slider)
    		<div class="item">
	            <div class="slider_content">
	            	<figure class="slider_img">
	            		<img src="{{ asset('upload/sliders/moto-slider-'.$slider->id.'.jpg') }}">
	            	</figure>
	            	 <div class="slider_content_text">
		            	<h3 class="ktm_orange">{{$slider->title}}</h3>
		            	<h2 class="ktm_white ">{{$slider->description}}</h2>
						<a href ="{{$slider->link}}" class="ktm_btn_primary ktm_shadon_5">Más información</a>
		            </div>
		        </div>
	        </div> 
	    @endforeach
        
    </div>
    
</section>

