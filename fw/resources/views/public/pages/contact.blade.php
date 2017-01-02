@extends('public.base')
@section('scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD-8zVwLcM-VjWlBjudpaUDtOXrUbwPgFA&libraries=geometry"></script>
<script src="{{asset('/js/contacto.js')}}" type="text/javascript"></script>
@stop
@section('body')
    <div class="cajadatos">
        <h2 class="subtitulo">Forma de Contacto</h2>
        <form id="formcontacto" class="margentop40">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="nombre">NOMBRE Y APELLIDO</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="nombre" id="nombre" data-required="1" data-tipo="txt" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-5">
                            <label for="nombre">MOVIL</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="movil" ng-model="checked" id="movil" data-required="1" data-tipo="txt" class="form-control" />
                        </div>
                    </div>


                    <div class="row margentop20">
                        <div class="col-sm-5">
                            <label for="nombre">CORREO ELECTRÓNICO</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="correo" id="correo" data-required="1" data-tipo="mail" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-5">
                            <label for="nombre">MENSAJE</label>
                        </div>
                        <div class="col-sm-7">
                            <textarea name="mensaje" id="mensaje" data-required="1" data-tipo="txt" class="form-control" cols="10" rows="6" /></textarea>
                        </div>
                    </div>

                    <div class="row margentop20 hidden-xs">
                        <div class="col-sm-7 col-sm-offset-5">
                            <a href="" id="btnenviar" class="enviar">ENVIAR</a>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>¿CÓMO TE GUSTARÍA RECIBIR NUESTRA RESPUESTA?</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="pull-right formaopc">
                                <label for="fmovil"><input type="radio" name="forma" id="fmovil" checked="checked" /> <span>MOVIL</span></label>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="pull-right formaopc">
                                <label for="fcorreo"><input type="radio" name="forma" id="fcorreo" /> <span>CORREO <br class="visible-xs" />ELECTRÓNICO</span></label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row margentop20">
                    <label>¿DURANTE QUE HORARIO TE GUSTARIA QUE TE LLAMEMOS?</label>
                        <div class="col-sm-2">
                            <label class="text-center">DE:</label>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control">
                              <option value="0">12:00 am</option>
                              <option value="1">1:00 am</option>
                              <option value="2">2:00 am</option>
                              <option value="3">3:00 am</option>
                              <option value="4">4:00 am</option>
                              <option value="5">5:00 am</option>
                              <option value="6">6:00 am</option>
                              <option value="7">7:00 am</option>
                              <option value="8">8:00 am</option>
                              <option value="9">9:00 am</option>
                              <option value="10">10:00 am</option>
                              <option value="11">11:00 am</option>
                              <option value="12">12:00 pm</option>
                              <option value="13">1:00 pm</option>
                              <option value="14">2:00 pm</option>
                              <option value="15">3:00 pm</option>
                              <option value="16">4:00 pm</option>
                              <option value="17">5:00 pm</option>
                              <option value="18">6:00 pm</option>
                              <option value="19">7:00 pm</option>
                              <option value="20">8:00 pm</option>
                              <option value="21">9:00 pm</option>
                              <option value="22">10:00 pm</option>
                              <option value="23">11:00 pm</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>A:</label>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control">
                              <option value="0">12:00 am</option>
                              <option value="1">1:00 am</option>
                              <option value="2">2:00 am</option>
                              <option value="3">3:00 am</option>
                              <option value="4">4:00 am</option>
                              <option value="5">5:00 am</option>
                              <option value="6">6:00 am</option>
                              <option value="7">7:00 am</option>
                              <option value="8">8:00 am</option>
                              <option value="9">9:00 am</option>
                              <option value="10">10:00 am</option>
                              <option value="11">11:00 am</option>
                              <option value="12">12:00 pm</option>
                              <option value="13">1:00 pm</option>
                              <option value="14">2:00 pm</option>
                              <option value="15">3:00 pm</option>
                              <option value="16">4:00 pm</option>
                              <option value="17">5:00 pm</option>
                              <option value="18">6:00 pm</option>
                              <option value="19">7:00 pm</option>
                              <option value="20">8:00 pm</option>
                              <option value="21">9:00 pm</option>
                              <option value="22">10:00 pm</option>
                              <option value="23">11:00 pm</option>
                            </select>
                        </div>
                    </div>
                 
                    <div class="row margentop20 hidden-lg hidden-md hidden-sm">
                        <div class="col-sm-7 col-sm-offset-5">
                            <a href="" id="btnenviar" class="enviar">ENVIAR</a>
                            <br>
                        </div>
                        <br>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-6">
                            <strong>Dirección:</strong><br><br>
                            Prol. Mariano Otero 680<br>
                            Zapopan, Jalisco<br>
                            México<br>
                            C.P. 45067<br><br>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <strong>Teléfono: (33) 3336 7487</strong>
                            <br><br>
                            <strong>Horario:</strong> Lunes a Viernes<br>
                            de 9:00  a 20:00<br>
                            (horario corrido)
                            <br>
                            <br>
                        </div>
                    </div>
                </div>

            <div id="mapa" class="margentop30"></div>
        </form>
    </div>

@stop