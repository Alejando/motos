var glimglam = angular.module("glimglamAdmin", ['ngRoute']);

glimglam.config(function($routeProvider){
    $routeProvider.
    when('/', {
        templateUrl : 'pages/admin/welcome.html',
        controller : 'homeCtrl'
    }).
    when('/subastas/en-proceso', {
        templateUrl : 'pages/admin/subastas-admin.html',
        controller : 'subastasEnProcesoCtrl'
    }).
    when('/subastas/terminadas', {
        templateUrl : 'pages/admin/subastas-admin.html',
        controller : 'subastasTerminadasCtrl'
    }).when('subastas/sin-publicar', {
        templateUrl : 'pages/admin/subastas-admin.html',
        controller : 'nuevaSubastaCtrl'
    });
    $routeProvider.when('/subastas/nueva', {
        templateUrl : 'pages/admin/subastas-form.html',
        controller : 'nuevaSubastaCtrl'
    }).
    when('/subastas/editar', {
        templateUrl : 'pages/admin/subastas-form.html',
        controller : 'edicionSubastaCtrl'
    }).
    when('/subastas/usuarios-lista', {
        templateUrl : 'pages/admin/usuarios-lista.html',
        controller : 'usuariosListaCtrl'
    }).
    when('/subastas/edicion-usuario', {
        templateUrl : 'pages/admin/usuarios-lista.html',
        controller : 'edicionDeUsuarioCtrl'
    }).
    when('/subastas/edicion', {
        templateUrl : 'pages/admin/form-contenidos.html',
        controller : 'edicionContenidoCtrl'
    }).
            
    when('/subastas/edicion/guia-de-uso', {
        templateUrl : 'pages/admin/form-contenidos.html',
        controller : 'edicionGuiaCtrl'
    }).
    when('/subastas/edicion/terminos', {
        templateUrl : 'pages/admin/form-contenidos.html',
        controller : 'edicionminosTerCtrl'
    }).
    when('/subastas/edicion/avisos', {
        templateUrl : 'pages/admin/form-contenidos.html',
        controller : 'edicionAvisoCtrl'
    })
    
    ;
});

glimglam.controller('mainCtrl', function($scope){
    $scope.msj = "Main Controller";
    $scope.subSeccion = false;
});

glimglam.controller('homeCtrl', function ($scope) {
    $scope.msj = "Bienvenidos";
});
glimglam.controller('edicionContenidoCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Edicion Contenido \"Acerca de...\"";
    $scope.titulo = "Acerca de ... ";
});

glimglam.controller('edicionGuiaCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Edicion Contenido \"Guia de uso\"";
    $scope.titulo = "Guia de uso ";
});

glimglam.controller('edicionminosTerCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Edicion Contenido \"Terminos y condiciones\"";
    $scope.titulo = "Terminos y condiciones";
});

glimglam.controller('edicionAvisoCtrl', function ($scope) {
    $scope.titulo = "Aviso de privacidad";
    $scope.$parent.subSeccion = "Edicion Contenido \"Aviso de privacidad\"";
});

glimglam.controller('subastasEnProcesoCtrl', function ($scope) {
  
    $scope.titulo = "Subastas En Proceso";
});

glimglam.controller('subastasTerminadasCtrl', function ($scope) {
    $scope.titulo = "Subastas Terminadas";
});

glimglam.controller('nuevaSubastaCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Nueva Subasta";
    $scope.titulo = "Nueva Subasta";
});

glimglam.controller('edicionSubastaCtrl', function ($scope) {
    $scope.titulo = "Edicion de subasta";
});

glimglam.controller('usuariosListaCtrl', function ($scope) {
    $scope.titulo = "Lista de Usuarios";
});

glimglam.controller('edicionDeUsuarioCtrl', function ($scope) {
    $scope.titulo = "Edicion de usuario";
});