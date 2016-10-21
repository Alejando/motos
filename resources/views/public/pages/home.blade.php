@extends('public.base')
@section('body')
    <nav>
        <ul class="menu sub-menu-productos">
            <li><a href="">POPULARES</a></li>
            <li><a href="">DESCUENTOS</a></li>
            <li><a href="">NUEVOS</a></li>
        </ul>
    </nav>

    <div class="row">
        @foreach($products as $product)
            @include('public.blocks.product',[
                'product' => $product
            ])
        @endforeach
    </div>
@stop