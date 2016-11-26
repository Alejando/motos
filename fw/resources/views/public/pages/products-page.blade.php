@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom' => false
])
@section('body')
    <div class="row products">        
        @forelse($products->items() as $product)
            @include('public.blocks.product', [ 
                'product' => $product,
                'categorySlug' => $categorySlug
            ])
        @empty
            <h3 style="text-align: center">No se encotraron productos</h3>
        @endforelse
    </div>
    <div class="text-center">*{!!$products->render();!!}</div>
@stop