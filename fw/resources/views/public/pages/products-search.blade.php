@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom' => false
])
@section('body')
    <div class="row products">        
        @forelse($products as $product)
            @include('public.blocks.product', [ 
                'product' => $product
            ])
        @empty
            <h3 style="text-align: center">No se encontraron productos</h3>
        @endforelse
    </div>
    <div class="text-center">*{!!$products->render();!!}</div>
@stop