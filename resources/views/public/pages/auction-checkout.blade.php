@extends('public.base')
@section('body')

<section class="container detalle-pago-subasta" ng-controller="public.checkoutPayCtrl">
    <div class="row">
        <div class="felicidades">
            ¡Felicidades {{$user->name}}!
        </div>
        <div class="col-sm-6">
            <div class="chk-head">Detalles de tu subasta</div>
            <div class="col-sm-4 nopadding borde-thumb">
                <i class="fa fa-trophy cover-t" aria-hidden="true"></i>
                <img src="{{$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}" class="thumb-cover">
            </div>
            <div class="col-sm-8">
                <p style="margin: 0;">Producto ganado:</p>
                <p class="subasta-nombre">{{$auction->title}}</p>
                <p style="margin: 0;">Oferta final:</p>
                <p class="subasta-tiempo2">${{$auction->last_offer}}</p>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="col-sm-6">
            <div class="chk-head">Checkout</div>
            <div class="form-factura">
                <form>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="rfc">RFC</label>
                            <input type="text" ng-model="billInfo.rfc" class="form-control" id="rfc" placeholder="" required>
                            <span class="error-message" ng-show="errors.rfc">@{{errors.rfc}}</span>
                            </div>
                          <div class="form-group">
                            <label for="razon">Razón Social</label>
                            <input type="text" class="form-control" ng-model="billInfo.business_name" id="razon-social" placeholder="" required>
                            <span class="error-message" ng-show="errors.address">@{{errors.business_name}}</span>
                          </div>
                            <div class="form-group">
                              <label for="domicilio">Domicilio</label>
                              <input type="text" class="form-control" ng-model="billInfo.address" id="domicilio" placeholder="" required>
                              <span class="error-message" ng-show="errors.address">@{{errors.address}}</span>
                            </div>
                            <div class="form-group">
                              <label for="colonia">Colonia</label>
                              <input type="text" class="form-control" ng-model="billInfo.neighborhood" id="colonia" placeholder="" required>
                              <span class="error-message" ng-show="errors.neighborhood">@{{errors.neighborhood}}</span>
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="postal">Código Postal</label>
                          <input type="text" class="form-control" ng-model="billInfo.postal_code" id="postal" placeholder="" required>
                          <span class="error-message" ng-show="errors.postal_code">@{{errors.postal_code}}</span>
                        </div>
                        <div class="form-group">
                          <label for="ciudad">Ciudad</label>
                          <input type="text" class="form-control" ng-model="billInfo.city" id="ciudad" placeholder="" required>
                          <span class="error-message" ng-show="errors.city">@{{errors.city}}</span>
                        </div>
                        <div class="form-group">
                          <label for="estado">Estado</label>
                          <input type="text" class="form-control" ng-model="billInfo.state" id="estado" placeholder="" required>
                          <span class="error-message" ng-show="errors.state">@{{errors.state}}</span>
                        </div>
                        <p style="font-size: 12px;font-style: italic;">Todos los campos son requeridos</p>
                    </div>
                  </form>
            </div>
            <div class="col-sm-8">
                <div class="chk-total">
                    <span>SUBASTA:</span>
                    <span id="enroll-sub-total" cant="{{$auction->last_offer}}">{{currency($auction->last_offer, config('app.currency') )}}</span>
                </div>
                <div class="chk-total">
                    <span>IVA:</span>
                    <span id="enroll-iva" cant="0.00">$0.00</span>
                </div>
                <div class="chk-total">
                    <span><strong>TOTAL:</strong></span>
                    <span id="enroll-total" cant="{{$auction->last_offer}}">{{currency($auction->last_offer, config('app.currency') )}}</span>
                </div>
            </div>
            <div class="col-sm-4 nopadding">
                <div class="checkbox">
                  <label>
                      <input class="facturar" type="checkbox"> Solicitar Factura
                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-offset-6 col-sm-6 margen-top">
            <div class="chk-head">Formas de Pago</div>
            <div class="col-sm-4">
                  <div class="radio">
                      <label><input class="paypal-select" checked="checked" type="radio" name="optradio">PayPal</label>
                  </div>
                {{--
                  <div class="radio disabled">
                      <label><input class="tdec-select" type="radio" name="optradio">Tarjeta de Crédito</label>
                  </div>
                --}}
            </div>
            <div class="col-sm-8">
                <div class="paypal-cont">
                    <img src="{{asset('img/logo-paypal.png')}}" class="img-responsive">
                    <p>Serás redireccionado a Paypal para efectuar tu pago.</p>
                    <a  data-code="{{$auction->code}}" class="btn btn-block btn-primary subasta-boton-pago btn-subasta-boton-pago" href="#" >Pagar</a>
                </div>
                {{--
                <div class="tdec-cont">
                    <form class="tdec-form text-left">
                          <div class="form-group">
                            <label for="tc-nombre">Nombre</label>
                            <input type="text" class="form-control" id="tc-nombre">
                          </div>
                          <div class="form-group">
                            <label for="tc-domicilio">Domicilio</label>
                            <input type="text" class="form-control" id="tc-domicilio">
                          </div>
                          <div class="form-group">
                            <label for="tc-cp">Código Postal</label>
                            <input type="text" class="form-control" id="tc-cp">
                          </div>
                          <div class="form-group">
                            <label for="tc-ciudad">Ciudad</label>
                            <input type="text" class="form-control" id="tc-ciudad">
                          </div>
                          <div class="form-group">
                            <label for="tc-estado">Estado</label>
                            <input type="text" class="form-control" id="tc-estado">
                          </div>
                          <div class="form-group">
                            <label for="tc-pais">País</label>
                            <input type="text" class="form-control" id="tc-pais">
                          </div>
                          <div class="form-group full">
                            <label for="tc-numero">Número de Tarjeta</label>
                            <input type="text" class="form-control" id="tc-numero">
                          </div>
                          <div class="form-group">
                            <label for="tc-mes">Mes</label>
                            <input type="text" class="form-control" id="tc-mes">
                          </div>
                          <div class="form-group">
                            <label for="tc-ano">Año</label>
                            <input type="text" class="form-control" id="tc-ano">
                          </div>
                          <div class="form-group">
                            <label for="tc-cvv">CVV</label>
                            <input type="text" class="form-control" id="tc-cvv">
                          </div>
                          <div class="form-group btn full">
                            <button type="submit" class="btn btn-primary">Pagar</button>
                          </div>
                    </form>
                </div>
                --}}
            </div>
            <div class="col-sm-12 leyenda-spam">
                Al realizar el pago, se enviará una notificación vía e-mail,si no la recibes en bandeja de entrada es recomendable verificar en tu correo spam.
            </div>
            @if( isset($error) && $error == true )
            <div class="col-xs-12">
                <p class="message-error text-right">{{$message}}</p>
            </div>
            @endif
        </div>
    </div>
</section>

@stop

