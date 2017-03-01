<section class=" category_motos">
	<div class="ktm_container section group ">
		<div class="col_motos span_2_of_2">
			<h3 class="ktm_white ">CATEGORÍAS KTM MOTOS</h3>
		</div>
		@for($i=0;$i<7;$i++)
			@if($i==0)
				<div class="col_motos  element_category">
					
					<div class="label_content">
						<figure class="label_img">
							<img src="img/svg/etiqueta.svg">				
						</figure>
						<p class="label_text ">MOTOCROSS</p>
					</div>
					<a href=""><figure class="category_img_big">
						<img src="img/motos/moto5.png">			
					</figure></a>
				</div>
			@elseif($i%2==0)
				<div class="col_motos element_category_right ">
					
					<div class="label_content">
						<figure class="label_img_multi">
							<img src="img/svg/etiqueta.svg">				
						</figure>
						<p class="label_text_multi">TRAVEL</p>
					</div>
					<a href=""><figure class="category_img">
						<img src="img/motos/moto1.png">			
					</figure></a>
				</div>
			@elseif($i%2!=0)
				<div class="col_motos element_category_left">
					
					<div class="label_content">
						<figure class="label_img_multi">
							<img src="img/svg/etiqueta.svg">				
						</figure>
						<p class="label_text_multi ">NAKED</p>
					</div>
					<a href=""><figure class="category_img">
						<img src="img/motos/moto2.png">			
					</figure></a>
				</div>
			@endif

		@endfor

	</div>
</section>