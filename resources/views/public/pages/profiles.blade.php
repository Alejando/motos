@extends('public.base')
@section('styles')
    <style>
        select.form-control2{
            padding:1em 1ex;;
        }
        @media (min-width: 768px) {
            select.form-control2.month {
                width: 121px;
                margin-left: -11px;
            }
        }
    </style>
@stop()
@section('js-scripts')
    @if(isset($conversion) && $conversion == true)
        <!-- Google Code for Conversion Page -->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 873741411;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "sX38CPyhlWoQ4_jQoAM";
        var google_remarketing_only = false;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/873741411/?label=sX38CPyhlWoQ4_jQoAM&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
    @else
        <script type="text/javascript">
            $(document).ready(function(){
               console.log('No hay conversion'); 
            });
        </script>
    @endif
@stop

@section('body')
    <section ng-controller="public.profileCtrl" style="display: none"  class="div-profile">
        <section class="fancy-producto">

        </section>
        <section class="container">
            <div class="banner-perfil ">
                <div class="datos-perfil">
                    <div>
                        <div class="foto-perfil" ng-click="changeImg();" >
                            <img src="img/edit-perfil-gg.png" class="img-responsive editar-img">
                           <a href="javascript:void(0);"><img id="foto-perfil" src="{{route('user.img-avatar',['userId'=>$user->id])}}" class="img-responsive img-profile"></a>
                        </div>
                         <input type="file" name="img-profile" id="img-profile" style="display: none">
                         <div class="nombre-usr-perfil">
                            <span>¡Hola!</span>
                            @{{user.name}} 
                        </div>
                        <div class="">
                            <div class="col-xs-12 col-sm-4 text-center">
                                {{--
                                <div class="col-xs-6 caja-responsive"  style="display: none">
                                    <div class="caja-contador participacion-p" >
                                        <span class="cant-participacion">@{{myTotalEnrollments | numberFixedLen:4}}</span>
                                        <p>En las que has participado</p>
                                    </div>
                                </div>
                                --}}
                                <div class="caja-responsive2">
                                    <div class="caja-contador ganado-p">
                                        <span class="cant-ganado">@{{myTotalWins | numberFixedLen:4}}</span>
                                        <p>Las que ya ganaste</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-sm-4 col-sm-offset-4 text-center">
                                <a href='{{asset("")}}' class="upcoming-btn">
                                    <div class="participacion-actual">
                                        <div class="img-actual"><span>Proximas subastas</span><img src="img/caja.png" class="img-responsive"></div>
                                    </div>
                                </a>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container">
                <div class="bg-blanco input-datos">
                    <div class="row btns-perfil">
                        <div class="col-md-8 col-md-offset-2">
                            <button ng-click="setSection('profile');" ng-class="{'perfil-activo':section=='profile'}" class="btn-perfil sw-perfil" type="submit">Mi Perfil</button>
                            <button ng-click="setSection('myEnrolmentsAuctions');" ng-class="{'perfil-activo':section=='myEnrolmentsAuctions'}" class="btn-perfil sw-detalles" type="submit">Mis Subastas</button>
                            <button ng-click="setSection('wins');" ng-class="{'perfil-activo':section=='wins'}" class="btn-perfil sw-detalles" type="submit">Ganadas </button>
                            <button ng-click="setSection('favs');" ng-class="{'perfil-activo':section=='favs'}" class="btn-perfil sw-metodo" type="submit">Mis Favoritas</button>
                        </div>
                    </div>
                    <div id="cont-inputs" class="row" ng-switch on="section">
                        <div ng-switch-default="profile">
                            @include('public.pages.profile.info')
                        </div>
                        <div  ng-switch-when="myEnrolmentsAuctions">
                            @include('public.pages.profile.my-auctions')
                        </div>
                        <div  ng-switch-when="wins">
                            @include('public.pages.profile.wins')
                        </div>
                        <div  ng-switch-when="favs">
                             @include('public.pages.profile.my-favs')
                        </div>
                    </div>
                </div>
        </section>
    </section>
@stop
