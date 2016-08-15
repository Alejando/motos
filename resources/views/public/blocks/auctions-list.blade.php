@for($i=0; $i<4; $i++)
    @if(isset($auctions[$i]))
        @include('public.blocks.product',['auction'=> $auctions[$i]])
    @endif
@endfor
@if(isset($auctions[4]))
    @include('public.blocks.products-horizotal-list', [
        'auction1' => $auctions[4],
        'auction2' => isset($auctions[5]) ? $auctions[5] : false
    ])
@endif

@if(isset($auctions[6]))
        @include('public.blocks.product', ['auction'=> $auctions[6] ])
@endif

@if(isset($auctions[7]))
    @include('public.blocks.products-horizotal-list', [
        'auction1' => $auctions[7],
        'auction2' => isset($auctions[8]) ? $auctions[8] : false
    ])
@endif

@if(isset($auctions[9]))
        @include('public.blocks.product',['auction'=> $auctions[9]])
@endif

@if(isset($auctions[10]))
        <div class="product-container col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="producto big-producto oferta-verde">
                <iframe class="video" width="420" height="315" src="http://www.youtube.com/embed/QH2-TGUlwu4?vq=hd1080&controls=0&iv_load_policy=3&rel=0&showinfo=0&color=white&disablekb=1" frameborder="0"></iframe>
                <!-- <iframe class="video" width="420" height="315" src="https://www.youtube.com/embed/XipavS_XF1I?rel=0&autohide=1&showinfo=0" frameborder="0" allowfullscreen></iframe> -->
            </div>
        </div>
        @include('public.blocks.product',['auction'=> $auctions[10]])
@endif
@if(isset($auctions[11]))
    @include('public.blocks.products-horizotal-list', [
        'auction1' => $auctions[11],
        'auction2' => isset($auctions[12]) ? $auctions[12] : false
    ])
@endif 