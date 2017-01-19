@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Dirección de envío</span>
    </div>

    <div class="pasos">
        <a href="./carrito" class="transicion"><span><b>1</b></span></a>
        <a href="./envio" class="transicion activo"><span><b>2</b></span></a>
        @if(\Auth::user()) 
            <a href="./pago" class="transicion"><span><b>3</b></span></a> 
        @endif
    </div>
<div class="cajadatos margentop30">       
            <div ng-controller="RegistrationFormCtrl" class="container col-sm-8 col-sm-offset-2" style="
                    background-color: rgba(250,250, 250, .5); 
                    border: solid 1px #8DC53E;
                    border-radius: 10px;
                    padding: 15px;
                ">
                <form ng-submit="submit()" novalidate="" name="registrationForm">
                    <h2 class="subtitulo">Registro</h2>
                    <div style="clear: both"></div>
                    <div class="text-center"><a href="{{route('facebook.login')}}"><img src="{{asset('img/facebook-login.png')}}" height="40"></a></div>
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" required="" ng-model="user.name" id="nombre" class="form-control" style="width: 100%"/>
                        </div>                        
                    </div>
                    <div class="alert alert-danger" ng-show="registrationForm.name.$touched && registrationForm.name.$invalid">
                        Nombre Obligatorio
                    </div>
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" required="" ng-model="user.email" id="nombre" class="form-control" style="width: 100%"/>
                        </div>
                    </div>
                    <div class=" alert alert-danger" ng-show="registrationForm.email.$touched && registrationForm.email.$invalid">
                        <div ng-show="registrationForm.email.$error.required"> - Email Obligatorio </div>
                        <div ng-show="registrationForm.email.$error.email"> - Escribe un email valido </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Contraseña</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" ng-model="user.password" name="password" id="nombre" required="" class="form-control" style="width: 100%"/>
                        </div>
                    </div>
                    <div class=" alert alert-danger" ng-show="registrationForm.password.$touched && registrationForm.password.$invalid">
                        Contraseña Obligatoria
                    </div>
                    <div class="form-group row">
                        <label for="nombre" class="col-form-label col-sm-2">Contraseña</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="password" ng-model="password" required="" name="confirm" id="nombre" class="form-control" style="width: 100%"/>
                        </div>
                    </div>
                    <div class="alert alert-danger" ng-show="
                        (registrationForm.confirm.$touched && registrationForm.confirm.$invalid) || 
                        (registrationForm.confirm.$touched && user.password!=password)
                         ">
                        <div ng-show="registrationForm.confirm.$error.required">Confirma tu contraseña</div>
                        <div ng-show="user.password!=password">- Tu contraseña y su confirmación no coinciden</div>
                    </div>
                    <div class="form-group row">
                        <div class="botonera  col-sm-offset-8 col-xs-offset-0">
                            <a href="" class="transicion" ng-click="submit()" ng-disabled="!registrationForm.$valid">Registrarme</a>
                        </div>
                    </div>
                    <div class="form-group row text-right" style="padding-right: 15px;">
                        <a href="{{route('cart.shiping')}}">Ya tengo una cuenta</a> 
                    </div>
                </form>
            </div>
            <div style="clear: both"></div>
    </div>
    
    
@stop