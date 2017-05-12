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
					<img src="{{ asset('img/svg/share.svg')}}" alt="Compartir Moto">
				</a>
			</div>
		    <div class="description ktm_center">
		    	<h3 class="ktm_orange ">DESCRIPCIÓN GENERAL DEL PRODUCTO</h3>
		    	<p class="paragraph">
		    		{{$product->description}}
		    	</p>
				<a   href="{{url('/contacto')}}" class="ktm_btn_primary ">Más información</a>
		    </div>
	</section>
	<section class="details_principal ">
		<div class="ktm_container ktm_center">
			<h3 class="ktm_white">PRINCIPALES CARACTERÍSTICAS</h3>
		</div>
      <?php
        $contador=1;
       ?>
			@foreach($product->features as $key => $feature)
        @if($feature->type->name=="Principales")
  				<div class="ktm_center col_feacture">
  					<div class="content_number">
  						<p class="number_feacture">{{ $contador }}</p>
  					</div>
  					<div class="text_feacture">
  						<p class="ktm_white">{{$feature->value}}</p>
  					</div>
  				</div>
          <?php
            $contador++;
           ?>
        @endif
			@endforeach
		<div class="ktm_center ktm_margin_20">
			<a href="{{url('/contacto')}}" class="ktm_btn_primary ">Soliciar más información</a>
		</div>
	</section>
	<section class="details_characteristics">
		@foreach($typeFeatures as $key => $type)
    @if($type->id!=1)
  			@if($key%2==0)
  				<div class="characteristic_1 ">
  					<div class="ktm_container">
  						<h3 class="ktm_white">{{$type->name}}</h3>
  					</div>
            @foreach($product->features as $key => $feature)
              @if($feature->type->id==$type->id)
  						<div class="ktm_container text_characteristic">
  							<div class="col_characteristic"><p class=" ktm_white">{{$feature->name}}</p></div>
  							<div class="col_characteristic"><p class=" ktm_white_light"> {{$feature->value}}</p></div>
  							<div class="ktm_separator_gray"></div>
  						</div>
              @endif
  					@endforeach
  				</div>
  			@else
  				<div class="characteristic_2">
  					<div class="ktm_container">
  						<h3 class="ktm_gray_dark">{{$type->name}}</h3>
  					</div>
            @foreach($product->features as $key => $feature)
              @if($feature->type->id==$type->id)
  						<div class="ktm_container text_characteristic">
  							<div class="col_characteristic"><p class=" ktm_gray_dark">{{$feature->name}}</p></div>
  							<div class="col_characteristic"><p class=" ktm_gray_middle"> {{$feature->value}}</p></div>
  							<div class="ktm_separator_gray"></div>
  						</div>
              @endif
  					@endforeach
  				</div>
  			@endif
      @endif
		@endforeach
	</section>

@stop
