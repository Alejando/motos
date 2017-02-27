@extends('public.base')
@section('body')
    @include('public.blocks.main-title')
	<section class="details_description">
		    <div id="owDetailsMoto" class="owl-carousel owl-theme">
		    	@for($i=0;$i<4;$i++)
		    		<div class="item">
			            <div class="content_img">
			            	<figure class="slider_img">
			            		<img src="{{ asset('img/motos/moto1.png') }}">
			            	</figure>
				        </div>
			        </div> 
			    @endfor
		    </div>
		    <div class="details_share">
				<a href="" class="ktm_btn_primary">
					<img src="img/svg/share.svg" alt="Compartir Moto">
				</a>
			</div>
		    <div class="description ktm_center">
		    	<h3 class="ktm_orange ">DESCRIPCIÓN GENERAL DEL PRODUCTO</h3>
		    	<p class="paragraph">
		    		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. 
		    	</p>
				<a  class="ktm_btn_primary ">Más información</a>
		    </div>
	</section>
	<section class="details_principal ">
		<div class="ktm_container ktm_center">
			<h3 class="ktm_white">PRINCIPALES CARACTERÍSTICAS</h3>
		</div>
			@for($i=0;$i<6;$i++)
				<div class="ktm_center col_feacture">
					<div class="content_number">
						<p class="number_feacture">{{ $i+1 }}</p>
					</div>
					<div class="text_feacture">
						<p class="ktm_white">Nuevo chasis rediseñado y mejorado, se redujo el peso y se aumento su fluidez.</p>
					</div>
				</div>
			@endfor
		<div class="ktm_center ktm_margin_20">
			<a href=""  class="ktm_btn_primary ">Soliciar más información</a>
		</div>
	</section>
	<section class="details_characteristics">	
		@for($i=0;$i<4;$i++)
			@if($i%2==0)
				<div class="characteristic_1 ">
					<div class="ktm_container">
						<h3 class="ktm_white">Motor</h3>
					</div>
					@for($j=0;$j<4;$j++)
						<div class="ktm_container text_characteristic">
							<div class="col_characteristic"><p class=" ktm_white">Estructura /Cilindrada:</p></div>
							<div class="col_characteristic"><p class=" ktm_white_light"> Motor Cilindrico de 4 tiempos/449.9 cm3</p></div>
							<div class="ktm_separator_gray"></div>
						</div>
					@endfor
				</div>
			@else
				<div class="characteristic_2">
					<div class="ktm_container">
						<h3 class="ktm_gray_dark">Motor</h3>
					</div>
					@for($j=0;$j<3;$j++)
						<div class="ktm_container text_characteristic">
							<div class="col_characteristic"><p class=" ktm_gray_dark">Estructura /Cilindrada:</p></div>
							<div class="col_characteristic"><p class=" ktm_gray_middle"> Motor Cilindrico de 4 tiempos/449.9 cm3</p></div>
							<div class="ktm_separator_gray"></div>
						</div>
					@endfor
				</div>
			@endif
		@endfor
	</section>
	
@stop