@extends('public.base')
@section('scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAGruDvAAyw2NV7gW-jjrDf7-kHKoj8BPA&libraries=geometry"></script>
<script src="{{asset('/js/contacto.js')}}" type="text/javascript"></script>
@stop
@section('body')
    <div class="cajadatos">
        <h2 class="subtitulo">Forma de Contacto</h2>
        <form id="formcontacto" class="margentop40">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="nombre">NOMBRE Y APELLIDO</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="nombre" id="nombre" data-required="1" data-tipo="txt" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-md-5">
                            <label for="nombre">MOVIL</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="movil" id="movil" data-required="1" data-tipo="txt" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-md-5">
                            <label for="nombre">CORREO ELECTRÓNICO</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="correo" id="correo" data-required="1" data-tipo="mail" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-md-5">
                            <label for="nombre">MENSAJE</label>
                        </div>
                        <div class="col-md-7">
                            <textarea name="mensaje" id="mensaje" data-required="1" data-tipo="txt" class="form-control" cols="10" rows="6" /></textarea>
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-md-7 col-md-offset-5">
                            <a href="" id="btnenviar" class="enviar">ENVIAR</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>¿CÓMO TE GUSTARÍA RECIBIR NUESTRA RESPUESTA?</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pull-right formaopc">
                                <input type="radio" name="forma" checked="checked" /> <span>MOVIL</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right formaopc">
                                <input type="radio" name="forma" /> <span>CORREO ELECTRÓNICO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mapa" class="margentop30"></div>
        </form>
    </div>


<!--div class="">
    <div><span></span> <span>DIRECCIÓN</span></div>
    <div><span></span><span>HORARIO DE ANTENCIÓN</span></div>
    <div><span></span><span>Servicio@bounce.com.mx</span></div>
</div>
<div>
    <form>
        <div class="col-sm-5 col-sm-offset-1">
            
            NOMBRE Y APELLIDO <input type="text" class="input-border">
            NO. CELULAR <input type="text" class="input-border">
            E-MAIL <input type="text" class="input-border">
            MENSAJE <textarea class="input-border"></textarea>
        </div>
        <div class="col-sm-5">
        ¿CÓMO TE GUSTARÍA RECIBIR NUESTRA RESPUESTA?
        
        NO. CELULAR EMAIL
        
        HORARIO 
        
        ENVIAR
        <div> Map
        </div>
        </div>
    </form>
</div-->
@stop