

@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="motos">
    	<div class= "motos_filter" ng-controller="PaginatorCtrl">
    		<div class="row">
    			<div class="col-xs-6 col-md-3">
    				{{$paginator->total()}} resultados
    			</div>
    			<div class="col-xs-6 col-md-3">
    				<div class="form-group">
    					<label  class="col-sm-6 control-label" for="per_page">Por página: </label>
    					<div class="col-sm-6">
		    				<select class="form-control" id="per_page" ng-model="per_page" ng-change="changePagination()">		    <option value="6">6</option>
		    					<option value="12">12</option>
		    					<option value="18">18</option>
		    				</select>

					    </div>
    				</div>
    			</div>
    			<div class="col-xs-6 col-md-3">
    				<div class="form-group">
    					<label  class="col-sm-4 control-label" for="order">Orden: </label>
    					<div class="col-sm-8">
		    				<select class="form-control" id="order" ng-model="order" ng-change="changePagination()">
		    					<option value="asc" ="">Ascendente (Nombre)</option>
		    					<option value="desc" ="">Descendente (Nombre)</option>
		    				</select>

					    </div>
    				</div>
    			</div>
    			<div class="col-xs-6 col-md-3">
    				@include('public.blocks.pagination')
    			</div>
    		</div>
	    </div>
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
	    <div class= "motos_filter" ng-controller="PaginatorCtrl">
    		<div class="row">
    			<div class="col-xs-6 col-md-3">
    				{{$paginator->total()}} resultados
    			</div>
    			<div class="col-xs-6 col-md-3">
    				<div class="form-group">
    					<label  class="col-sm-6 control-label" for="per_page">Por página: </label>
    					<div class="col-sm-6">
		    				<select class="form-control" id="per_page" ng-model="per_page" ng-change="changePagination()">		    <option value="6">6</option>
		    					<option value="12">12</option>
		    					<option value="18">18</option>
		    				</select>

					    </div>
    				</div>
    			</div>
    			<div class="col-xs-6 col-md-3">
    				<div class="form-group">
    					<label  class="col-sm-4 control-label" for="order">Orden: </label>
    					<div class="col-sm-8">
		    				<select class="form-control" id="order" ng-model="order" ng-change="changePagination()">
		    					<option value="asc" ="">Ascendente (Nombre)</option>
		    					<option value="desc" ="">Descendente (Nombre)</option>
		    				</select>

					    </div>
    				</div>
    			</div>
    			<div class="col-xs-6 col-md-3">
    				@include('public.blocks.pagination')
    			</div>
    		</div>
	    </div>
    </section>

 @stop
