<div class="product-container col-lg-2 col-md-3 col-sm-6 col-xs-12">
    @include('public.blocks.product-horizontal',['auction'=>$auction1])
    @if($auction2)
        @include('public.blocks.product-horizontal',['auction'=>$auction2])
    @else
        <div class="producto mini-producto placeholder aqua">
        </div>
    @endif
</div>