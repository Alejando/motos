<div class="row-fluid">
    <div class="producto mini-producto oferta-verde col-md-12">
        <div class="timer-subasta"><i class="fa fa-clock-o animated infinite pulse" aria-hidden="true"></i></div>
        <div class="img-subasta">
            <img src="{{$auction->getUrlCover($auction::COVER_HORIZONTAL)}}" alt="Producto 1" title="Producto 1">
        </div>
        <div class="producto-hover transition-0-3 col-md-12">
            <div class="producto-titulo">{{$auction->title}}</div>
            <div class="producto-actions">
                <div class="producto-heart"></div>
                <span class="producto-separador"></span>
                <div class="producto-hammer" id_producto="001"></div>
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
