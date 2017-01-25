@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom'=>true
])
@section('body')
    <button>Imprimir</button>
    <button>Descargar</button>
    <iframe src="{{route('cart.conecta-oxxo-format', ['format' => 'html', 'order'=> $order->id ])}}">
        
        
    </iframe>
@stop