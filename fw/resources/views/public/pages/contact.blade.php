@extends('public.base')
@section('scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD-8zVwLcM-VjWlBjudpaUDtOXrUbwPgFA&libraries=geometry"></script>
<script src="{{asset('/js/contacto.js')}}" type="text/javascript"></script>
@stop
@section('body')
    <div id="lat" style="display: none" value="{{DwSetpoint\Models\DBConfig::getMapaLatitud()}}"></div>
    <div id="lng" style="display: none" value="{{DwSetpoint\Models\DBConfig::getMapaLongitud()}}"></div>
    <div id="zoom" style="display: none" value="{{DwSetpoint\Models\DBConfig::getMapaZoom()}}"></div>
    <div class="cajadatos">
        @if ($Mge_sent)
          <div class="alert alert-success">
            ¡Nos pondremos en contacto contigo en la brevedad, Gracias!.
          </div>
        @endif
        @if ($errors->has())
          <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  {{ $error }}<br>        
              @endforeach
          </div>
        @endif
        
        <h2 class="subtitulo">Forma de Contacto</h2>
        <form id="formcontacto" class="margentop40" action="{{ url('request/contact') }}" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="nombre">*NOMBRE Y APELLIDO</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="nombre" id="nombre" data-required="1" data-tipo="txt" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-5">
                            <label for="nombre">*MOVIL</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="movil" ng-model="checked" id="movil" data-required="1" data-tipo="txt" class="form-control" />
                        </div>
                    </div>


                    <div class="row margentop20">
                        <div class="col-sm-5">
                            <label for="nombre">*CORREO ELECTRÓNICO</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="e-mail" name="correo" id="correo" data-required="1" data-tipo="mail" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-5">
                            <label for="nombre">*MENSAJE</label>
                        </div>
                        <div class="col-sm-7">
                            <textarea name="mensaje" id="mensaje" data-required="1" data-tipo="txt" class="form-control" cols="10" rows="6" /></textarea>
                        </div>
                    </div>

                    <div class="row margentop20 hidden-xs">
                        <div class="col-sm-7 col-sm-offset-5">
                            <button id="btnenviar" class="enviar">ENVIAR</button>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>¿CÓMO TE GUSTARÍA RECIBIR NUESTRA RESPUESTA?</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="pull-right formaopc">
                                <label for="fmovil"><input type="radio" name="forma" id="fmovil" checked="checked" value="vía móvil" /> <span>MÓVIL</span></label>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="pull-right formaopc">
                                <label for="fcorreo"><input type="radio" name="forma" id="fcorreo" value="vía correo" /> <span>CORREO <br class="visible-xs" />ELECTRÓNICO</span></label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row margentop20">
                    <div class="col-sm-12">
                      <label>¿DURANTE QUE HORARIO TE GUSTARÍA QUE TE LLAMEMOS?</label>
                    </div>
                    
                        <br>
                        <div class="col-sm-2">
                            <label class="text-center">DE:</label>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="hora_inicio">
                              <option value="12:00 am">12:00 am</option>
                              <option value="1:00 am">1:00 am</option>
                              <option value="2:00 am">2:00 am</option>
                              <option value="3:00 am">3:00 am</option>
                              <option value="4:00 am">4:00 am</option>
                              <option value="5:00 am">5:00 am</option>
                              <option value="6:00 am">6:00 am</option>
                              <option value="7:00 am">7:00 am</option>
                              <option value="8:00 am">8:00 am</option>
                              <option value="9:00 am">9:00 am</option>
                              <option value="10:00 am">10:00 am</option>
                              <option value="11:00 am">11:00 am</option>
                              <option value="12:00 pm">12:00 pm</option>
                              <option value="1:00 pm">1:00 pm</option>
                              <option value="2:00 pm">2:00 pm</option>
                              <option value="3:00 pm">3:00 pm</option>
                              <option value="4:00 pm">4:00 pm</option>
                              <option value="5:00 pm">5:00 pm</option>
                              <option value="6:00 pm">6:00 pm</option>
                              <option value="7:00 pm">7:00 pm</option>
                              <option value="8:00 pm">8:00 pm</option>
                              <option value="9:00 pm">9:00 pm</option>
                              <option value="10:00 pm">10:00 pm</option>
                              <option value="11:00 pm">11:00 pm</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>A:</label>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="hora_final">
                              <option value="12:00 am">12:00 am</option>
                              <option value="1:00 am">1:00 am</option>
                              <option value="2:00 am">2:00 am</option>
                              <option value="3:00 am">3:00 am</option>
                              <option value="4:00 am">4:00 am</option>
                              <option value="5:00 am">5:00 am</option>
                              <option value="6:00 am">6:00 am</option>
                              <option value="7:00 am">7:00 am</option>
                              <option value="8:00 am">8:00 am</option>
                              <option value="9:00 am">9:00 am</option>
                              <option value="10:00 am">10:00 am</option>
                              <option value="11:00 am">11:00 am</option>
                              <option value="12:00 pm">12:00 pm</option>
                              <option value="1:00 pm">1:00 pm</option>
                              <option value="2:00 pm">2:00 pm</option>
                              <option value="3:00 pm">3:00 pm</option>
                              <option value="4:00 pm">4:00 pm</option>
                              <option value="5:00 pm">5:00 pm</option>
                              <option value="6:00 pm">6:00 pm</option>
                              <option value="7:00 pm">7:00 pm</option>
                              <option value="8:00 pm">8:00 pm</option>
                              <option value="9:00 pm">9:00 pm</option>
                              <option value="10:00 pm">10:00 pm</option>
                              <option value="11:00 pm">11:00 pm</option>
                            </select>
                        </div>
                    </div>
                 
                    <div class="row margentop20 hidden-lg hidden-md hidden-sm">
                        <div class="col-sm-7 col-sm-offset-5">
                            <button id="btnenviar" class="enviar">ENVIAR*</button>
                            <br>
                        </div>
                        <br>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-5">
                            <strong><i class="fa fa-map-marker fa-lg" style="color: #cb2027;"></i> Dirección:</strong><br><br>
                            {{DwSetpoint\Models\DBConfig::getAddressStreet()}}<br>
                            {{DwSetpoint\Models\DBConfig::getAddressCity()}}<br>
                            {{DwSetpoint\Models\DBConfig::getAddressCountry()}}<br>
                            {{DwSetpoint\Models\DBConfig::getAddressPc()}}<br><br>
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <strong><i class="fa fa-phone fa-lg" style="color: #125688;"></i> Teléfono:&nbsp;&nbsp;&nbsp;&nbsp;</strong> {{DwSetpoint\Models\DBConfig::getTelContact()}}<br>
                            <strong><i class="fa fa-whatsapp fa-lg" style="color: #4dc247;"></i> WhatsApp:&nbsp;</strong> {{DwSetpoint\Models\DBConfig::getTelWhatsapp()}}
                            <br><br>
                            <strong><i class="fa fa-clock-o fa-lg" style="color: #ce7c02;"></i> Horario:</strong> {!!DwSetpoint\Models\DBConfig::getSchedule()!!}
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
              <div id="mapa" class="margentop30"></div>
              
        </form>
    </div>

@stop