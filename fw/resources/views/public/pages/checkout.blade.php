@extends('public.base')
@section('body')
<div ng-controller="CartCheckoutCtrl">
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Método de pago</span>
    </div>    
    <div class="pasos">
        <a href="{{route('cart.list')}}" class="transicion"><span><b>1</b></span></a>
        <a href="{{route('cart.shiping')}}" class="transicion"><span><b>2</b></span></a>
        <a href="{{route('cart.confirmCheckout')}}"  class="transicion activo"><span><b>3</b></span></a>
    </div>
    
    <div class="cajadatos margentop30">
        <h2 class="subtitulo">Forma de Pago</h2>
        <form id="formpago" method="post">
            <div class="infox margentop20">
                <div class="col-xs-10 col-sm-10 col-md-10">
                     <h4>Web 100% confidencial</h4>
                    En Bounce protegemos tus datos, toda la información de tus tarjetas viaja codificada con tecnología SSL, es decir, tus datos viajan encriptados y nadie tiene acceso a ellos.
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <img style="width:100%; padding-top: 10%" src="{{asset('/css/McAfee_Secure.svg')}}"/>
                </div>
               
            <div class="cajadatos margentop20 ng-hide" ng-show="pspError"  ng-cloak>
                <h2 class="title text-center" style="color:red" >@{{pspError}}<i class="fa fa-times" aria-hidden="true"></i></h2>
            </div>
            @if(isset($checkout) && $checkout=='fail')
                <div class="cajadatos margentop20">
                    <h2 class="title text-center" style="color:red" >Ocurrio un error al intentar procesar tu pago <i class="fa fa-times" aria-hidden="true"></i></h2>
                    <div class="nproductoh4">* Intenta nuevamente con otra forma de pago</div>
                </div>
            @endif
            
            <div class="row margentop20" ng-cloak>
                <div class="col-sm-4">
                <br>
                    <h3 class="subtitulo">Elige tu método de pago:</h3>
                    <div class="panel-group margentop20 widthlimit" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" style="display: none">
                            <div class="panel-heading" role="tab" id="headingOne" >
                                <h4 class="panel-title">
                                    <a class="btnacordeon" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Pago con tarjeta 
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12"><label for="tarjeta">No. Tarjeta</label></div>
                                        <div class="col-md-12">
                                            <input type="text" name="tarjeta" id="tarjeta" class="form-control" placeholder="0000 0000 0000 0000" />
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12"><label for="mes">Vigencia</label></div>
                                        <div class="col-md-5"><input type="text" name="mes" id="mes" class="form-control" placeholder="mm" /></div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5"><input type="text" name="year" id="year" class="form-control" placeholder="yyyy" /></div>   
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12"><label for="clave">CVV</label></div>
                                        <div class="col-md-5"><input type="text" name="clave" id="clave" class="form-control" placeholder="000" /></div>    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default " ng-click="setProvider(cart.PSP_PAYPAL)">
                            <div class="panel-heading" role="tab" id="headingTwo"  ng-class="{
                                bntProviederChekout: providerSelected == cart.PSP_PAYPAL
                             }"                        
                            >
                                <h4 class="panel-title">
                                    <a class="btnpaypal" role="button" href="" aria-expanded="true" aria-controls="collapseTwo">
                                        Pago con PayPal
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default " ng-click="setProvider(cart.PSP_OXXO_CONEKTA)">
                            <div class="panel-heading" role="tab" id="headingTwo"  ng-class="{
                                bntProviederChekout: providerSelected == cart.PSP_OXXO_CONEKTA
                             }"                        
                            >
                                <h4 class="panel-title">
                                    <a class="btnoxxo" role="button" href="" aria-expanded="true" aria-controls="collapseTwo">
                                        Pago en OXXO
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default"  ng-click="setProvider(cart.PSP_TC_CONEKTA)">
                            <div class="panel-heading" role="tab" id="headingTwo" ng-class="{
                                bntProviederChekout: providerSelected == cart.PSP_TC_CONEKTA
                             }">
                                <h4 class="panel-title">
                                    <a class="btnconekta" role="button" href="" aria-expanded="true" aria-controls="collapseTwo">
                                        Pago con Tarjeta
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div ng-show="providerSelected == cart.PSP_TC_CONEKTA">
                        @include('public.pages.cart.form-conekta')
                    </div>
                </div>
                <div class="col-sm-5">
                <br>
                    <h3 class="subtitulo2">Resúmen de Compra</h3>
                    <div class="cajaresumen margentop20">
                        <div class="contenidoresumen">
                            <div class="row nproducto" ng-repeat="item in items">
                                <div class="col-xs-8">
                                    <h4 class="nproductoh4">
                                        @{{item.product.name}}
                                        <span>@{{item.getPrice()|currency:'$'}} x @{{item.quantity()}}</span>
                                    </h4>
                                </div>
                                <div class="col-xs-4">
                                    <h5 class="nproductoh5">@{{item.getSubTotal()|currency:'$'}}</h5>    
                                </div>
                            </div>
                            
                            <div class="row cajon" ng-show="item.getDiscount()">
                                <div class="col-xs-6">
                                    Descuento cupón:
                                </div>
                                <div class="col-xs-6" >
                                    @{{item.getDiscount()|currency:'$'}} MXP
                                </div>
                            </div>
                            <div class="row cajon">
                                <div class="col-xs-6">
                                    Subtotal:
                                </div>
                                <div class="col-xs-6">
                                    @{{cart.getSubTotal()|currency:'$'}} MXP
                                </div>
                            </div>
                            <div class="row cajon" ng-show="cart.getDiscount()">
                                <div class="col-xs-6">
                                    Descuento cupón:
                                </div>
                                <div class="col-xs-6">
                                   - @{{cart.getDiscount()|currency:'$'}} MXP
                                </div>
                            </div>
                            <div class="row cajon">
                                <div class="col-xs-6">
                                    Paquetería:
                                </div>
                                <div class="col-xs-6">
                                    @{{cart.getShippingAmount()|currency:'$'}} MXP
                                </div>
                            </div>
                            <div class="row cajon" ng-show="cart.requestBillig()">
                                <div class="col-xs-6">
                                    Iva:
                                </div>
                                <div class="col-xs-6">
                                    @{{cart.getTax()|currency:'$'}} MXP
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <br>
                    <h2 class="checktotal margentop50">
                        <span>Total:</span> <span>@{{cart.getTotal()|currency:'$'}}</span>
                    </h2>
                    <div class="botonera margentop20">
                        <a href="" class="transicion" ng-hide="sending" ng-click="checkout($event)">Comprar</a>
                        <div ng-show="sending">
                            <img src="{{asset('/css/loadingModalInfo.gif')}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('scripts')
    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
    <script type="text/javascript">
        Conekta.setPublishableKey({!!json_encode(DwSetpoint\Models\DBConfig::getConektaPublicKey())!!});
    </script>
@stop