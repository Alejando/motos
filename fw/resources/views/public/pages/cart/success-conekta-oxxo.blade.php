@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom'=>true
])
@section('body')
<div ng-controller="OxxoConfirmCtrl">
    <button ng-click="print()">Imprimir</button>
    <button ng-click="download()">Descargar</button>
    <iframe class="iframe-print" src="{{route('cart.conecta-oxxo-format', ['format' => 'html', 'order'=> $order->id ])}}"></iframe>
</div>
@stop