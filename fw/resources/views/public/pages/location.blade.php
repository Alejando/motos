@extends('public.base')
@section('scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD-8zVwLcM-VjWlBjudpaUDtOXrUbwPgFA&libraries=geometry"></script>
<script src="{{asset('/js/contacto.js')}}" type="text/javascript"></script>
@stop
@section('body')
<div>
    <!--div class="address-map">
        <a href="https://goo.gl/maps/iRRgwiDNTcy" target="_blank">
            <img border="0" class="address-img" src="//maps.googleapis.com/maps/api/staticmap?center=20.6293307,-103.4404401&zoom=16&size=1000x500&markers=color:red|20.6293307,-103.4404401&key=AIzaSyBimYo3oz8Evj6Z-TYA01ncmpArptMg4Uk" alt="">
        </a>
    </div-->

    <div class="address-content col-md-12">
        <h2>Dirección</h2>
        <div class="col-md-6">    
            Prol. Mariano Otero 680<br>
            Mariano Otero<br>
            Zapopan, Jalisco<br>
            México<br>
            C.P. 45067<br><br>
        </div>
        <div class="col-md-6">
            <b>Teléfono: (33) 3336 7487</b><br><br>
            Horario: Lunes a Viernes<br>
            de 9:00  a 20:00<br>
            (horario corrido)
        </div>
    </div>

    <div id="mapa" class="margentop30"></div>

    <div class="test col-md-12">
        <style>
            .pic{
                width:50px;
                height:50px;
            }
            .picbig{
                position: absolute;
                width:0px;
                -webkit-transition:width 0.3s linear 0s;
                transition:width 0.3s linear 0s;
                z-index:10;
            }
            .pic:hover + .picbig{
                width:200px;
            }
        </style>
    </div>
</div>
@stop