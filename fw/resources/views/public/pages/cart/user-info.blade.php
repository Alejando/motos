@extends('public.base')
@section('body')
<div  ng-controller="CartClientInfoCtrl" class="infoShipping" style="display: none">
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Dirección de envío</span>
    </div>
    <div class="pasos">
        <a href="{{route('cart.list')}}" class="transicion"><span><b>1</b></span></a>
        <a href="{{route('cart.shiping')}}" class="transicion activo"><span><b>2</b></span></a>
        @if(\Auth::user()) 
            <a href="" ng-click="nextStep($event)" ng-class = "{
                disabled : !valid(false) 
            }" class="transicion" ng-show="cart.getShippingAddress()" ><span><b>3</b></span></a> 
        @endif
    </div>
    <div class="cajadatos margentop30">       
        @if(!\Auth::user())
            @include('public.pages.form-login')
            <div style="clear: both"></div>
        @else
            <h2 class="subtitulo">Datos de Envío</h2>
            @include('public.pages.cart.form-shiping-address')
            @include('public.pages.cart.form-billing-information')
        @endif
    </div>
    @if(\Auth::user())
        <div class="botonera margentop50">
            <a href="#" class="transicion" ng-class = "{
                disabled : !valid(false) 
            }" ng-click="nextStep($event)">Continuar</a>
        </div>
    @endif
</div>
@stop
