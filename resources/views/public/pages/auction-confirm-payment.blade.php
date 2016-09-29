@extends('public.base')
@section('body')

<section class="container detalle-pago-subasta">
    <div class="row">
        <div class="col-sm-12">
            <div class="chk-head">Detalles de tu pago</div>
            <div class="col-sm-6 borde-thumb">
                <i class="fa fa-ticket cover-t" aria-hidden="true"></i>
                <img src="{{$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}" class="thumb-cover">
            </div>
            <div class="col-sm-6 text-center">
                <p>
                    Subasta pagada:
                </p>
                <h3 class="subasta-nombre">
                    {{$auction->title}}
                </h3>
            </div>
            <div class="col-sm-6" style="margin-top: 35px;">
                <p class="text-center">¡Felicidades!, tu producto será envíado pronto</p>
            </div>
            <div style="clear:both;"></div>
        </div>
        
        <div class="row">
            <p class="text-center"><a class="btn btn-primary" href="{{asset('')}}">¡Jugar más!</a></p>
        </div>
    </div>
</section>

@stop