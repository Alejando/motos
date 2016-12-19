@extends('public.base')
@section('body')
<div  ng-app="setpoint" ng-controller="CartListItemCtrl" class="cart" style="display:none">
        <form novalidate name="formCart" role="form">        
            <div class="breadcrumbcustom">
                Inicio <span class="separador">-</span> <span class="current">Carrito de compras</span>
            </div>
            <div class="pasos">
                <a href="{{route('cart.list')}}" class="transicion activo"><span><b>1</b></span></a>
                <a href="{{route('cart.shiping')}}" class="transicion"><span><b>2</b></span></a>
                @if(\Auth::user()) 
                    <a href="./pago" class="transicion"><span><b>3</b></span></a>
                @endif
            </div>
            <div class="cajacarrito margentop30">
                <div class="row fila" ng-repeat="item in items">
                    <div class="col-sm-2 hidden-xs">
                        <div class="btnvista" style="background: url('@{{item.product.getURLCover()}}') center center;"></div>
                    </div>
                    <div class="col-sm-2 col-xs-4">
                        <div class="cajatxt">
                            <div>
                                <h3 class="productonombre">
                                    @{{item.product.name}}
                                    <span>Num. Serie @{{item.product.serial_number}}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 hidden-xs">
                        <div class="cajatxt">
                            <div>
                                <h3 class="productonombre">
                                    Precio Unitario
                                    <b>@{{item.price|currency}}</b>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-4">
                        <div class="cajatxt">
                            <div>
                                <h3 class="productonombre">
                                    Cantidad
                                    <input type="number" name="cantidad" ng-model="item.quantity" ng-change="cart.persistItems()" ng-model-options="{ getterSetter: true }" min="1">
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-4">
                        <div class="cajatxt">
                            <div>
                                <h3 class="productonombre">
                                    Subtotal
                                    <b>@{{item.getSubTotal()|currency}}</b>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 hidden-xs">
                        <div class="cajatxt">
                            <div>
                                <a href="" ng-click="removeItem(item)" class="btneliminar transicion"><div><span>X</span></div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margentop30">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="pull-right cajacupon" ng-hide="cart.getDiscount()">
                        <h3 class="subtitulo hidden-xs">Canjea Cupón</h3>
                        <input type="text" 
                               ng-model="couponCode"
                               ng-change="couponChange()" 
                               class="hidden-xs"
                               ng-class="{error:errorCoupon}"
                        />
                        <input type="text"
                               ng-model="couponCode" 
                               ng-change="couponChange()"
                               class="visible-xs" 
                               placeholder="Canjea Cupón" 
                               ng-class="{error:errorCoupon}"
                        />
                        <a class="btncupon transicion" ng-click="applyCoupon()">Aplicar</a>
                        <div class="alert alert-danger" ng-show="errorCoupon"> 
                            <div ng-show="errorCoupon">* @{{errorCouponMessage}}</div>
                        </div>
                </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="cuenta">
                        <div class="row">
                            <div class="col-xs-6"><span class="cgris">Subtotal</span></div>
                            <div class="col-xs-6"><span class="cgris">@{{cart.getSubTotal()|currency}}</span></div>
                        </div>
                        <div class="row descuento" ng-show="cart.getDiscount()"> 
                            <div style="float: right"><a href="" ng-click="removeCoupon()" class="danger fa fa-times drager" style="color: red; font-size: 14px; position:relative; top: -6px; left: -2px"></a></div>
                            <div class="col-xs-6"><span>Descuento cupón</span></div>
                            <div class="col-xs-6"><span>- @{{cart.getDiscount()|currency}}</span></div>
                        </div>
                        <div class="row envio">
                            <div class="col-xs-6"><span>Envío</span></div>
                            <div class="col-xs-6"><span>$000.00</span></div>
                        </div>
                        <div class="row total">
                            <div class="col-xs-6"><span>Total</span></div>
                            <div class="col-xs-6"><span>@{{cart.getTotal()|currency}}</span></div>
                        </div>
                    </div>

                    <div class="cuenta margentop20">
                        <div class="row">
                            <div class="col-md-12"><span class="cazul">Método de envío</span></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><span class="cgris">Paquetería</span></div>
                            <div class="col-xs-6">
                                <select name="paqueteria" id="paqueteria" class="form-control combo">
                                    <option value="">Fedex</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><span class="cgris">Servicio</span></div>
                            <div class="col-xs-6">
                                <select name="servicio" id="servicio" class="form-control combo">
                                    <option value="">Nacional</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><span class="cgris">Tipo</span></div>
                            <div class="col-xs-6">
                                <select name="tipo" id="tipo" class="form-control combo">
                                    <option value="">Terrestre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="botonera margentop50">
                <a href="./envio" class="transicion">Continuar</a>
            </div>  
        </form>
    </div>
@stop