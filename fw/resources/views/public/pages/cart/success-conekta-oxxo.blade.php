@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom'=>true
])
@section('body')
<div class="row col-md-12 col-sm-12" ng-controller="OxxoConfirmCtrl">
    <h2 class="titulo text-center margentop20">Tu pedido ha sido procesado correctamente <i class="fa fa-check" style="color:green" aria-hidden="true"></i></h2>
    <div class="col-md-10 col-md-offset-1 margentop20">
          <h3 class="text-center">No. Pedido: {{$order->id}}</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 margentop20">
        <p class="subtitulo">* Puedes imprimir o descargar tu formato para realizar el pago en OXXO</p>
        <div class="botonera margentop50 text-center">
        	<iframe style="display:none;" class="iframe-print" src="{{route('cart.conecta-oxxo-format', ['format' => 'html', 'order'=> $order->id ])}}"></iframe>
	    	<a href="" ng-click="print()">Imprimir</a>
	    	<a href="" ng-click="download()">Descargar</a>
	    </div>
    </div>
</div>

@stop