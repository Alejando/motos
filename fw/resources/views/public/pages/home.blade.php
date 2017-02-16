@extends('public.base')
@section('body')
{{-- <nav id="mostrar">
    <ul class="menu sub-menu-productos">
        <li><a class="secction_active" href="{{url('/#mostrar')}}">PRODUCTOS</a></li>
        <li><a href="{{url('descuentos#mostrar')}}">DESCUENTOS</a></li>
        <li><a href="{{url('nuevos#mostrar')}}">NUEVOS</a></li>
    </ul>
</nav>

<div class="row products">
    @foreach($products as $product)
    @include('public.blocks.product',[
    'product' => $product
    ])
    @endforeach
</div>
<div class="text-center">{!!$products->render();!!}</div> --}}
@stop