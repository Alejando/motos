<section class=" category_motos">
	<div class="ktm_container section group ">
		<div class="col_motos span_2_of_2">
			<h3 class="ktm_white ">CATEGORÍAS KTM MOTOS</h3>
		</div>
		@foreach(\DwSetpoint\Models\Category::getChildrenBySlug('motos') as $key=>$subcategory)
                                            

			@if($key==0)
				<div class="col_motos  element_category">

					<div class="label_content">
						<figure class="label_img">
							<img src="img/svg/etiqueta.svg">
						</figure>
						<p class="label_text ">{{strtoupper($subcategory->name)}}</p>
					</div>
					<a href="{{url('/motos/'.$subcategory->name)}}"><figure class="category_img_big">
						<img src="img/motos/moto5.png">
					</figure></a>
				</div>
			@elseif($key%2==0)
				<div class="col_motos element_category_right ">

					<div class="label_content">
						<figure class="label_img_multi">
							<img src="img/svg/etiqueta.svg">
						</figure>
						<p class="label_text_multi">{{strtoupper($subcategory->name)}}</p>
					</div>
					<a href="{{url('/motos/'.$subcategory->name)}}"><figure class="category_img">
						<img src="img/motos/moto1.png">
					</figure></a>
				</div>
			@elseif($key%2!=0)
				<div class="col_motos element_category_left">

					<div class="label_content">
						<figure class="label_img_multi">
							<img src="img/svg/etiqueta.svg">
						</figure>
						<p class="label_text_multi ">{{strtoupper($subcategory->name)}}</p>
					</div>
					<a href="{{url('/motos/'.$subcategory->name)}}"><figure class="category_img">
						<img src="img/motos/moto2.png">
					</figure></a>
				</div>
			@endif

		@endforeach

	</div>
</section>
