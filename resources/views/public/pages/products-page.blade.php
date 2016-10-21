@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom' => false
])
@section('body')
    <div class="row">
        @forelse($products->items() as $product)
            @include('public.blocks.product', [ 
                'product' => $product 
            ])
        @empty
            <h3 style="text-align: center">No se encotraron productos</h3>
        @endforelse
    </div>
@stop