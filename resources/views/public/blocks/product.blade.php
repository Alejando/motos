<div class="product-container {{ isset($room) && $room ?  'col-lg-3' : 'col-lg-2'}} col-md-3 col-sm-6 col-xs-12" data-slug="{{str_slug($auction->title,'-')}}">
    <div class="producto  {{$auction->getOfferType()}}">
        @if($auction->inOffer())
            <div class="label-offer"></div>
        @elseif($auction->isPreSaleDay())
            <div class="label-preventa"></div>
        @endif
        <div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
        <div class="img-subasta">
            <img src="{{$auction->getUrlCover($auction::COVER_VERTICAL)}}" alt="{{$auction->title}}" title="{{$auction->title}}">
        </div>
        <div class="leyenda-subasta">
            <div>Rango de oferta desde:</div>
            <div class="rango-ofertas">{{currency($auction->min_offer, config('app.currency'))}} - {{Currency::format($auction->max_offer, config('app.currency'))}}</div>
        </div>
        <div id_producto="{{$auction->code}}" class="producto-hover transition-0-3 link-subasta no-border">
            <div class="producto-titulo{{strlen($auction->title) < 50 ? ' producto-titulo-grande' : '' }}">{{$auction->title}}</div>
            <div class="producto-actions">
                <div class="producto-heart{{ (isset($favs) && in_array($auction->id, $favs)) ? ' in-fav':''}}"></div>
                <span class="producto-separador"></span>
                <div class="producto-hammer" id_producto="{{$auction->code}}"></div>
            </div>
            <div class="producto-cover">
                <div>Tu asiento:</div>
                @if($auction->isPreSaleDay())<span>{{Currency::format($auction->getOriginalCover() ,config('app.currency'))}}</span> @endif{{Currency::format($auction->getCoverAttribute(), config('app.currency'))}}
            </div>
            <div class="leyenda-cover">
                <!--Tu asiento-->
            </div>
        </div>
    </div>
</div>