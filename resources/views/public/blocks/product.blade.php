<div class="product-container col-lg-2 col-md-3 col-sm-6 col-xs-12">
    <div class="producto  {{$auction->getOfferType()}}">
        <div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
        <div class="img-subasta">
            <img src="{{$auction->getUrlCover($auction::COVER_VERTICAL)}}" alt="Producto 1" title="Producto 1">
        </div>
        <div class="leyenda-subasta">
            <div>Puedes subastar desde:</div>
            <div class="rango-ofertas">{{currency($auction->min_offer, config('app.currency'))}} - {{Currency::format($auction->max_price, config('app.currency'))}}</div>
        </div>
        <div class="producto-hover transition-0-3">
            <div class="producto-titulo">{{$auction->title}}</div>
            <div class="producto-actions">
                <div class="producto-heart"></div>
                <span class="producto-separador"></span>
                <div class="producto-hammer" id_producto="{{$auction->code}}"></div>
            </div>
            <div class="producto-cover">
                {{Currency::format($auction->cover, config('app.currency'))}}
            </div>
            <div class="leyenda-cover">
                Tu Lugar
            </div>
        </div>
    </div>
</div>