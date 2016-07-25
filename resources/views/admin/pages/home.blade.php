@extends('public.base')
@section('body')
<div ng-app="glimglamAdmin" ng-controller="mainCtrl">
    <div class="title-section shadow" ng-show="subSeccion">
        <span>Administración</span> 
        / <span>@{{subSeccion}}</span>
    </div> 
    <div id="main">
      <div ng-view></div> 
    </div>
</div>
@stop
@section('js-scripts')
    
    <script type="text/javascript" src="{{asset('js/bower_components/angular/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/angular-route/angular-route.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/estrasol/admin.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"></script>
@stop
@section('styles')
<link rel="stylesheet" href="{{asset('css/estrasol/admin.css')}}">
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

@stop
@section('nav-top')
    <ul class="nav nav-pills">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Subastas
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#subastas/en-proceso">En Proceso</a></li>
                <li><a href="#subastas/terminadas">Terminadas</a></li>
                <li><a href="#subastas/sin-publicar">Sin Publicar</a></li>
                <li><a href="#subastas/nueva">Nueva</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Contenidos
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#/subastas/edicion">Acerca De...</a></li>
                <li><a href="#/subastas/edicion/guia-de-uso">Guia De Uso</a></li>
                <li><a href="#/subastas/edicion/avisos">Aviso de privacidad</a></li>
                <li><a href="#/subastas/edicion/terminos">Terminos y condiciiones</a></li>
            </ul>
        </li>
        <li><a href="#">Usuarios</a></li>
        <li><a href="http://demo.estrasol.com.mx/glimglam/">Salir</a></li>
    </ul>
@stop