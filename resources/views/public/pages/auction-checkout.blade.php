@extends('public.base')
@section('body')
<div class="container bg-blanco" ng-controller="public.checkOutCtrl">
    <div>
        <div style="width: 80%; margin: auto;" class="fact-form" method="POST" action="">
            <div class="form-group row">
                {{$auction->title}}
                <img src="{{$auction->getUrlCover($auction::COVER_HORIZONTAL)}}">
                <div class="col-sm-12 text-center">
                    <button class="btn-login btn-primary" ng-click="pay()"> Realizar pago</button>
                </div>
            </div>
        </div>
   </div>
</div>
@stop

