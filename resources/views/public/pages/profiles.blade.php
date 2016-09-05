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
@section('body')
<section ng-controller="public.profileCtrl" style="display: none"  class="div-profile">
    <section class="fancy-producto">
      
    </section>
    <section class="container">
        <div class="banner-perfil ">
            <div class="datos-perfil">
                <div>
                    <div class="foto-perfil" ng-click="changeImg();" style="display: none">
                        <img src="img/edit-perfil-gg.png" class="img-responsive editar-img">
                       <a href="javascript:void(0);"><img id="foto-perfil" src="{{route('user.img-avatar',['userId'=>$user->id])}}" class="img-responsive img-profile"></a>
                    </div>
                     <input type="file" name="img-profile" id="img-profile" style="display: none">
                     <div class="nombre-usr-perfil" style="position: relative; top: 10px">
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

@section('scripts')
    <script type="text/javascript">
//        $('.sw-perfil').click(function() {
//          $('#cont-inputs').html('<div class="col-md-12 inputs-mgn"><form class="login-form"><div class="row"><div class="col-sm-6"> <div class="form-group row"> <div class="col-sm-12"> <div class="row"> <div class="col-sm-6"> <input type="text" name="nombre" class="form-control2" placeholder="Nombre"> </div><div class="col-sm-6 margen-tf"> <input type="text" name="apellido" class="form-control2" placeholder="Apellido"> </div></div></div></div><div class="form-group row"> <div class="col-sm-12"> <input type="email" name="correo" class="form-control2" placeholder="Correo electrónico"> </div></div><div class="form-group row"> <div class="col-sm-12"> <select name="sexo" class="form-control2"> <option value="" disabled selected>Sexo...</option> <option value="hombre">Hombre</option> <option value="mujer">Mujer</option></select> </div></div></div><div class="col-sm-6"> <div class="form-group row"> <div class="col-sm-12"> <div class="row"> <div class="col-xs-4 nac"> <select name="dia" class="form-control2" placeholder="Día"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> <option value="24">24</option> <option value="25">25</option> <option value="26">26</option> <option value="27">27</option> <option value="28">28</option> <option value="29">29</option> <option value="30">30</option> <option value="31">31</option> </select> </div><div class="col-xs-4 nac margen-nac"> <select name="mes" class="form-control2" placeholder="Mes"> <option value="1">Enero</option> <option value="2">Febrero</option> <option value="3">Marzo</option> <option value="4">Abril</option> <option value="5">Mayo</option> <option value="6">Junio</option> <option value="7">Julio</option> <option value="8">Agosto</option> <option value="9">Septiembre</option> <option value="10">Octubre</option> <option value="11">Noviembre</option> <option value="12">Diciembre</option> </select> </div><div class="col-xs-4 nac"> <select name="year" class="form-control2" placeholder="Año"> <option value="1956">1956</option> <option value="1957">1957</option> <option value="1958">1958</option> <option value="1959">1959</option> <option value="1960">1960</option> <option value="1961">1961</option> <option value="1962">1962</option> <option value="1963">1963</option> <option value="1964">1964</option> <option value="1965">1965</option> <option value="1966">1966</option> <option value="1967">1967</option> <option value="1968">1968</option> <option value="1969">1969</option> <option value="1970">1970</option> <option value="1971">1971</option> <option value="1972">1972</option> <option value="1973">1973</option> <option value="1974">1974</option> <option value="1975">1975</option> <option value="1976">1976</option> <option value="1977">1977</option> <option value="1978">1978</option> <option value="1979">1979</option> <option value="1980">1980</option> <option value="1981">1981</option> <option value="1982">1982</option> <option value="1983">1983</option> <option value="1984">1984</option> <option value="1985">1985</option> <option value="1986">1986</option> <option value="1987">1987</option> <option value="1988">1988</option> <option value="1989">1989</option> <option value="1990">1990</option> <option value="1991">1991</option> <option value="1992">1992</option> <option value="1993">1993</option> <option value="1994">1994</option> <option value="1995">1995</option> <option value="1996">1996</option> <option value="1997">1997</option> <option value="1998">1998</option> <option value="1999">1999</option> <option value="2000">2000</option> <option value="2001">2001</option> <option value="2002">2002</option> <option value="2003">2003</option> <option value="2004">2004</option> <option value="2005">2005</option> <option value="2006">2006</option> <option value="2007">2007</option> <option value="2008">2008</option> <option value="2009">2009</option> <option value="2010">2010</option> <option value="2011">2011</option> <option value="2012">2012</option> <option value="2013">2013</option> <option value="2014">2014</option> <option value="2015">2015</option> <option value="2016">2016</option> </select> </div></div></div></div><div class="form-group row"> <div class="col-sm-12"> <select name="interes" class="form-control2" placeholder="Intereses"> <option value="" disabled selected>Elige un interés...</option> <option value="1">Electrónica</option> <option value="2">Joyería</option> <option value="3">Coleccionable</option> <option value="4">Decoración</option> <option value="5">Prendas</option> </select> </div></div></div></div><div class="checkbox text-center"> <label> <input type="checkbox"> Acepto los <a href="javascript:void(0);">Términos y Condiciones</a> </label> </div><div class="form-group row"> <div class="col-sm-12 text-center"> <button type="submit" class="btn-login btn-primary">Guardar</button> </div></div></form></div>');
//        });
//
//        $('.sw-detalles').click(function() {
//          $('#cont-inputs').html('<div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div><div class="col-md-3 inputs-mgn"><div class="caja-detalle"><img src="img/caja.png" class="img-responsive"><div id="titulo-en-detalle" class="titulo-en-detalle">Reloj Mediterraneo</div><div id="fecha-subasta" class="fecha-subasta">00/00/00</div><div id="precio-inicial" class="precio-inicial">Cantidad inicial<span style="text-align: right;float: right;font-weight: bold;">$500.00</span></div><div id="precio-final" class="precio-final">GANASTE<span style="text-align: right;float: right;font-weight: bold;">$2300.00</span></div></div></div>');
//        });
//
//        $('.sw-metodo').click(function() {
//          $('#cont-inputs').html('<div class="col-md-4 inputs-mgn"><div class="caja-metodo"><img src="img/paypal.png" class="img-responsive"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked><p>Para utilizar PayPal solo necesitas registrar un correo electrónico y una tarjeta de débito o crédito.</p></div></div><div class="col-md-4 inputs-mgn"><div class="caja-metodo"><img src="img/mercadopago.png" class="img-responsive"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" ><p>Ingresas los datos de tu tarjeta una sola vez. En las futuras compras solo te pediremos el código de seguridad.</p></div></div><div class="col-md-4 inputs-mgn"><div class="caja-metodo"><img src="img/conekta.png" class="img-responsive"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" ><p>Ahora podrás cobrar sin enviar a tus clientes a una página externa, pedirles crear una cuenta o autenticarse.</p></div></div><div class="col-md-12"><form class="login-form"> <div class="form-group row"> <div class="col-sm-12"> <input type="email" name="correo" class="form-control2" placeholder="Correo electrónico"> </div></div><div class="form-group row"> <div class="col-sm-12"> <input type="password" name="password_paypal" class="form-control2" placeholder="Contraseña"> </div></div><div class="form-group row"> <div class="col-sm-12 text-center"> <button type="submit" class="btn-login btn-primary">Guardar</button> </div></div></form></div>');
//        });
    </script>
@stop
