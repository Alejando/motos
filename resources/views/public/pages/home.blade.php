@extends('public.base')
@section('body')
    
<div ng-controller="public.IndexCtrl">
    @{{titulo}}
</div>

{{--@foreach($aunctions as $auction)--}}
<!--    <div class="product-container col-lg-2 col-md-3 col-sm-6 col-xs-12">
			<div class="producto oferta-verde">
				<div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
				<div class="img-subasta">
					<img src="img/productos/producto01.png" alt="Producto 1" title="Producto 1">
				</div>
				<div class="leyenda-subasta">
					<div>Puedes subastar desde:</div>
					<div class="rango-ofertas">${{$auction->minOffer}}.00- ${{$auction->maxOffer}}.00</div>
				</div>
				<div class="producto-hover transition-0-3">
					<div class="producto-titulo">{{$auction->titles}}</div>
					<div class="producto-actions">
						<div class="producto-heart"></div>
						<span class="producto-separador"></span>
						<div class="producto-hammer" id_producto="001"></div>
					</div>
					<div class="producto-cover">
						${{$auction->cover}}.00
					</div>
					<div class="leyenda-cover">
						Tu Lugar
					</div>
				</div>
			</div>
		</div>-->
{{--@endforeach--}}


@stop
@section('js-scripts')
    <script type="text/javascript" src="{{asset('js/estrasol/index.js')}}"></script>
@stop

