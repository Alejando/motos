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
    
    {{-- JS para el selector de horas--}}
    <script type="text/javascript" src="{{asset('js/bower_components/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/angular-moment/angular-moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/angular-clockpicker/dist/angular-clockpicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/lng-clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/re-tree/re-tree.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/ng-device-detector/ng-device-detector.min.js')}}"></script>
    {{-- Js para el selector de fechas--}}
    
    <script type="text/javascript" src="{{asset('js/bower_components/angular-bootstrap/ui-bootstrap-tpls.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/bootstrap-ui-datetime-picker/dist/datetime-picker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bower_components/angular-i18n/angular-locale_es-mx.js')}}"></script>
    
    {{-- JS para textAngular---}}
    <script src="{{asset('js/bower_components/textAngular/dist/textAngular-rangy.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bower_components/textAngular/dist/textAngular-sanitize.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bower_components/textAngular/dist/textAngular.min.js')}}" type="text/javascript"></script>
    
    {{-- Js para datatables --}}
    <script src="{{asset('js/bower_components/datatables/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bower_components/angular-datatables/dist/angular-datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bower_components/datatables/media/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bower_components/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.min.js')}}" type="text/javascript"></script>
    
    
    {{-- Js para dropzone --}}
    <script src="{{asset('js/bower_components/dropzone/downloads/dropzone.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bower_components/angular-dropzone/lib/angular-dropzone.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/laroute.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"></script>
    
    <script type="text/javascript" src="{{asset('js/estrasol/admin.js')}}"></script>
@stop
@section('styles')
    <link rel="stylesheet" href="{{asset('css/estrasol/admin.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('js/bower_components/lng-clockpicker/dist/jquery-clockpicker.min.css')}}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <link href="{{asset('js/bower_components/dropzone/downloads/css/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('js/bower_components/textAngular/dist/textAngular.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('js/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    {{-- Estilos para datatables--}}
    <!--<link href="{{asset('js/bower_components/angular-datatables/dist/css/angular-datatables.min.css')}}" rel="stylesheet" type="text/css"/>-->
    <link href="{{asset('js/bower_components/datatables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    
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
                <li><a href="#/actulizar-masiva">Actualización Masiva</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Contenidos
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#/contenidos/acerca-de">Acerca de</a></li>
                <li><a href="#/contenidos/guia-de-uso">Guía de uso</a></li>
                <li><a href="#/contenidos/avisos">Aviso de privacidad</a></li>
                <li><a href="#/contenidos/terminos">Términos y condiciones</a></li>
                <li><a href="#/contenidos/preguntas-frecuentes">Preguntas frecuentes</a></li>
                
            </ul>
        </li>
        <li><a href="#/clientes">Usuarios</a></li>
        <li><a href="http://demo.estrasol.com.mx/glimglam/">Salir</a></li>
    </ul>
@stop