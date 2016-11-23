@extends('public.base')
@section('body')
<nav>
    <ul class="menu sub-menu-productos">
        <li><a href="{{url('populares')}}">POPULARES</a></li>
        <li><a href="{{url('descuentos')}}">DESCUENTOS</a></li>
        <li><a href="{{url('nuevos')}}">NUEVOS</a></li>
    </ul>
</nav>

<div class="row products">
    @foreach($products as $product)
    @include('public.blocks.product',[
    'product' => $product
    ])
    @endforeach
</div>
<div class="text-center">{!!$products->render();!!}</div>
@stop