@extends('public.base')
@section('body')

<section class="container detalle-pago-subasta">
    <div class="row">
        <div class="col-sm-6">
            <div class="chk-head">Detalles de tu asiento</div>
            <div class="col-sm-4 nopadding borde-thumb">
                <i class="fa fa-ticket cover-t" aria-hidden="true"></i>
                <img src="{{$auction->getUrlCover($auction::COVER_SLIDER_UPCOMING)}}" class="thumb-cover">
            </div>
            <div class="col-sm-8">
                <p style="margin: 0;">Acceso a:</p>
                <p class="subasta-nombre">{{$auction->title}}</p>
                <p style="margin: 0;">Fecha de inicio:</p>
                <p><span class="subasta-tiempo2 countdown" expiration="{{$auction->start_date}}"></span></p>
                
            </div>
            <div class="col-xs-6" style="display: none;">
                <div class="caja-contador participacion-p">
                    <span class="cant-participacion">{{$auction->users_limit}}</span>
                    <p>Maximo de participantes</p>
                </div>
            </div>
            <div class="col-xs-6" style="display: none;">
                <div class="caja-contador ganado-p">
                    <span class="cant-ganado">{{$auction->total_enrollments}}</span>
                    <p>Participantes registrados</p>
                </div>
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
                            <input type="text" class="form-control" id="rfc" placeholder="" required>
                          </div>
                          <div class="form-group">
                            <label for="razon">Razón Social</label>
                            <input type="text" class="form-control" id="razon-social" placeholder="" required>
                          </div>
                            <div class="form-group">
                              <label for="domicilio">Domicilio</label>
                              <input type="text" class="form-control" id="domicilio" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="colonia">Colonia</label>
                              <input type="text" class="form-control" id="colonia" placeholder="" required>
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="postal">Código Postal</label>
                          <input type="text" class="form-control" id="postal" placeholder="" required>
                        </div>
                        <div class="form-group">
                          <label for="ciudad">Ciudad</label>
                          <input type="text" class="form-control" id="ciudad" placeholder="" required>
                        </div>
                        <div class="form-group">
                          <label for="estado">Estado</label>
                          <input type="text" class="form-control" id="estado" placeholder="" required>
                        </div>
                        <p style="font-size: 12px;font-style: italic;">Todos los campos son requeridos</p>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
            </div>
            <div class="col-sm-8">
                <div class="chk-total">
                    <span>ASIENTO:</span>
                    <span>{{currency($auction->cover, config('app.currency') )}}</span>
                </div>
                <div class="chk-total">
                    <span>IVA:</span>
                    <span>$0.00</span>
                </div>
                <div class="chk-total">
                    <span><strong>TOTAL:</strong></span>
                    <span>{{currency($auction->cover, config('app.currency') )}}</span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                  <label>
                      <input class="facturar" type="checkbox"> Solicitar Factura
                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-6 margen-top">
            <div class="chk-head">Formas de Pago</div>
            <div class="col-sm-4">
                  <div class="radio">
                      <label><input class="paypal-select" checked="checked" type="radio" name="optradio">PayPal</label>
                  </div>
                  <div class="radio disabled">
                      <label><input class="tdec-select" type="radio" name="optradio">Tarjeta de Crédito</label>
                  </div>
            </div>
            <div class="col-sm-8">
                <div class="paypal-cont">
                    <img src="{{asset('img/logo-paypal.png')}}" class="img-responsive">
                    <p>Serás redireccionado a Paypal para efectuar tu pago.</p>
                    <a class="btn btn-block btn-primary subasta-boton-pago" href="{{route('auction.checkout',['code' => $auction->code])}}">Pagar</a>
                </div>
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
            </div>
        </div>
    </div>
</section>

@stop