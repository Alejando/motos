<?php 
$imgs = $auction->getUrlImg();
$numItems = count($imgs['fancy-box-small']);
$widthGallery = $numItems * 104;
$widthGallery = 'width: '.$widthGallery.'px';
/* @var $fechaInicio DateTime */
$fechaInicio = new \DateTime($auction->start_date); 
$fechaInicio->setTimezone(new \DateTimeZone("America/Mexico_City"));

$text = 'Subasta+de+'. urlencode($auction->title);
$details='Subasta+en+sitio+GlimGlam';
$location=asset('subastas/juego').'/'.$auction->code;
/* @var $startdate DateTime */
$timezoneMX = new \DateTimeZone("America/Mexico_City");
$utc = new \DateTimeZone("UTC");

$startdate = $auction->getPreSaleDate($timezoneMX);
$startdate->setTime(0, 0, 0);
$startdate->setTimezone($utc);
$startdate = $startdate->format('Ymd\THis\Z');

$enddate= $auction->getPreSaleDate($timezoneMX);
$enddate->setTime(23, 59, 59);
$enddate->setTimezone($utc);
$enddate = $enddate->format('Ymd\THis\Z');

$preSaleDate = $auction->getPreSaleDate($timezoneMX);
$preSaleDate = $preSaleDate->format('d/m/Y');

$calendarLink = sprintf('http://www.google.com/calendar/render?'.
        'action=TEMPLATE&'.
        'text=%s&'.
        'dates=%s/%s&'.
        'details=%s&'.
        'location=%s&',
        $text, 
        $startdate, 
        $enddate, 
        $details, 
        $location
);



//https://www.google.com/calendar/render?action=TEMPLATE&text=TextoEjemplo&dates=20140127T224000Z/20140320T221500Z&details=For+details,+link+here:+http://www.example.com&location=Waldorf+Astoria,+301+Park+Ave+,+New+York,+NY+10022&sf=true&output=xml
//
//https://www.google.com/calendar/render?action=TEMPLATE&text=TextoEjemplo&dates=20160907T000000Z/20160907T230000Z&details=Subasta+en+sitio+GlimGlam&location=http://192.168.1.111/DW.glimglam/public/subastas/juego/SUB002
?>
<div class="fancy-close">
    <script>
        var numItems = {{$numItems}} - 1;
    </script>
    <div class="product" data-code="{{$auction->code}}">
        <div class="col-sm-6 col-sm-push-6 col-md-7 col-md-push-5 text-center close-fancy">
            <div class="descripcion-fancy">
                <div class="fancybox-close text-right">
                    <i class="fa fa-times fa-2x close-fancy" aria-hidden="true"></i>
                </div>
                <div class="fancy-titulo">{{$auction->title}}</div>
                <div class="leyenda-subasta">
                    <div>Rango de oferta desde:</div>
                    <div class="rango-ofertas">{{currency($auction->min_offer, config('app.currency'))}} - {{Currency::format($auction->max_offer, config('app.currency'))}}</div>
                </div>
                <div class="btns-descripcion"></div>
                <div class="fancy-txt">
                    {!!nl2br($auction->description)!!}
                </div>
                <div style="padding: 10px">
                    Llévatelo por menos de <b>{{Currency::format(ceil($auction->max_price), config('app.currency'))}}</b>
                    en lugar de <b>{{Currency::format(ceil($auction->real_price), config('app.currency'))}}</b> (precio real)
                </div>
                <div style="padding: 10px">Inicia el <b>{{$fechaInicio->setTimezone($timezoneMX)->format('d/m/Y')}}</b> a las <b>{{$fechaInicio->format('H:i')}}</b></div>
                @if($auction->isBuyable())
                    @if($auction->code=='SUB010')
                        <div>
                            <img src='{{asset("img/sala_llena.png")}}'>
                        </div>
                    @else
                        <div class="producto-boton-entrar">
                            <a class="link-subasta transition-0-3" href="{{route('auction.enrollment-form', ['auction' => $auction->code])}}">
                                <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                            </a>
                        </div>
                    @endif
                @elseif( $auction->isStarted() || $auction->isFinished() )
                <span class="leyenda-no-disponible">Esta preventa ya no esta disponible</span>
                @else
                <span>Fecha de preventa: <b>{{$preSaleDate}}</b></span>
                <a class="google-calendar" href="{{$calendarLink}}"
                    target="_blank">
                    Agregar preventa a Google Calendar<br>
                </a>
                <span class="leyenda-no-disponible">La preventa todavía no inicia</span>
                <div class="producto-boton-entrar">
                    <a class="link-subasta-disabled transition-0-3" href="{{route('auction.enrollment-form', ['auction' => $auction->code])}}">
                        <span class="link-hammer transition-0-3"><span class="icon-hammer"></span></span><span class="link-subasta-text">Entrar</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @if(isset($imgs['fancy-box-thumbailn'][0]))
        <div class="col-sm-6 col-sm-pull-6 col-md-5 col-md-pull-7 text-center close-fancy @if($auction->isPreSaleDay()) presale @endif">
            <div class="producto-fancy ">
                <div class="recorte-superior"></div>
                @if($auction->isPreSaleDay())<div class="label-preventa"></div>@endif
                <div class="producto-fancy-cover">
                    <span>Tu asiento</span>
                    <span class="precio-cover">
                        @if($auction->isPreSaleDay())
                        <span class="strike">{{Currency::format($auction->getOriginalCover(), config('app.currency'))}}</span>
                        @endif
                        <span class="{{$auction->isPreSaleDay() ? 'oferta':''}}">{{Currency::format($auction->cover, config('app.currency'))}}</span>
                    </span>
                </div>
                <div id="img-principal" class="producto-fancy-img" style="display: none">
                    <div class="fancy-gallery-control control-left"><i class="fa fa-angle-left fa-3x" aria-hidden="true"></i></div>
                    <div class="fancy-gallery-control control-right"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></i></div>
                    <img id="fancy-zoom" class="zoom_mw" src="{{$imgs['fancy-box-thumbailn'][0]}}" data-zoom-image="{{$imgs['fancy-box-zoom'][0]}}" alt="{{$auction->title}}" title="{{$auction->title}}">
                </div>
                <section class="fancy-gallery">
                    <div class="fancy-fallery-container" style="{{$widthGallery}}">
                        @foreach($imgs["fancy-box-small"] as $i => $img)
                        <a href="#" class="frame-gallery gal-{{$i}}{{$i == 0 ? ' active' : ''}}" gal-num="{{$i}}" data-image="{{$imgs["fancy-box-thumbailn"][$i]}}" data-zoom-image="{{$imgs["fancy-box-zoom"][$i]}}">
                            <img src="{{$imgs["fancy-box-small"][$i]}}" alt="{{$auction->title}}" title="{{$auction->title}}">
                        </a>
                        @endforeach
                    </div>
                </section>
                <div class="share-fancy-container">
                    <a id="share-room" class="share-room share-fb" target="popup" href="{{URL::to('/#!'.$auction->code.'/'.str_slug($auction->title))}}"></a>
                    <a class="share-room share-tw" href="http://twitter.com/share?url={{URL::to('/sub/'.$auction->code)}}&text=¡{{$auction->title}} está siendo subastado!&hashtags=glimglam,subastaonline" title="GlimGlam subastas online" target="popup"></a>
                </div>
                <div class="recorte-inferior"></div>
            </div>
        </div>
        @else 
        <div class="col-sm-3 col-md-3 col-md-offset-0 text-center fancybox-close">

        </div>
        @endif
    </div>
</div>
<script>
    $('.share-room.share-fb').on('click', function(e) {
        e.preventDefault();
        FB.ui({
          method: 'share',
          display: 'popup',
          picture: {!!json_encode($auction->getUrlCover($auction::COVER_HORIZONTAL))!!},
          description: {!!json_encode($auction->description)!!},
          title: {!!json_encode($auction->title)!!},
          caption: 'GlimGlam subastas online',
          href: this.href,
        }, function(response){});
    });
    
    $('.share-room.share-tw').on("click", function(e) {
        $(this).customerPopup(e);
    });
    
    $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
        // Prevent default anchor event
        e.preventDefault();
        // Set values for window
        intWidth = intWidth || '500';
        intHeight = intHeight || '400';
        strResize = (blnResize ? 'yes' : 'no');

        // Set title and open popup with focus on it
        var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'GlimGlam subastas online'),
            strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
            objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
    }    
</script>
