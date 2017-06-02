@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="motos">
    	@include('public.blocks.pagination')
	    @foreach($paginator as $key=>$product)
	    	@if($key%2==0)
		    	<div class="motos_content_2">
		    @else
		    	<div class="group motos_content_1">
		    @endif
		    	<a href="{{route('details-moto',$product->id)}}">
			    	<div class="img_background">
				    	<figure class="img_content">
				    		<img src="{{asset('img/motos/moto1.png')}}" alt="Moto">
				    	</figure>
			    	</div>
			    	<div class="text_background">
			    		<div class="text_content">
			    			<h2 class="ktm_orange">{{$product->name}}</h2>
				    		<h5 class="ktm_gray_middle">{{$product->color}}</h5>
				    		<h3 class="ktm_orange">FUNCIONES PRINCIPALES</h3>
				    		@foreach($product->features as $key=> $feature)
				    			@if($feature->type->name=="Principales")
			         				<p class="feacture ktm_black"> <strong>{{$feature->name}}: </strong></p>
				    				<P class="feacture_description ktm_gray_dark" >{{$feature->value}}</P>
			         			@endif

				    		@endforeach
			    		</div>
			    	</div>
			   	</a>
			   	<div class="motos_share">
			    	<a href="" class="ktm_btn_primary">
						<img src="{{asset('img/svg/share.svg')}}" alt="Compartir Moto">
					</a>
			    </div>
		    </div>
	    @endforeach
	    @include('public.blocks.pagination')
    </section>

 @stop
