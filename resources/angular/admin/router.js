
glimglam.config(function ($routeProvider) {
    $routeProvider.
            when('/', {
                templateUrl: 'pages/admin/welcome.html',
                controller: 'homeCtrl'
            }).
            when('subastas/sin-publicar', {
                templateUrl: 'pages/admin/subastas-admin.html',
                controller: 'nuevaSubastaCtrl'
            })              
    .when('/subastas/nueva', {
        templateUrl: 'pages/admin/subastas-form.html',
        controller: 'nuevaSubastaCtrl'
    })
    .when('/actulizar-masiva', { 
        templateUrl: 'pages/admin/actulizar-masiva.html',
        controller: 'actualizacionMasivaCtrl'
    })
    .when('/subastas/:status', {
        templateUrl: 'pages/admin/subastas-admin.html',
        controller: 'subastasCtrl'
    });
    $routeProvider.when('/subasta/:code',{
        templateUrl: 'pages/admin/subasta.html',
        controller: 'subastaCtrl'
    });     
    
    $routeProvider.when('/contenidos/:slug', {
        templateUrl: 'pages/admin/form-contenidos.html',
        controller: 'edicionContenidoCtrl'
    });
    $routeProvider.
            when('/subastas/editar', {
                templateUrl: 'pages/admin/subastas-form.html',
                controller: 'edicionSubastaCtrl'
            }).
            when('/subastas/usuarios-lista', {
                templateUrl: 'pages/admin/usuarios-lista.html',
                controller: 'usuariosListaCtrl'
            }).
            when('/subastas/edicion-usuario', {
                templateUrl: 'pages/admin/usuarios-lista.html',
                controller: 'edicionDeUsuarioCtrl'
            }).
            when('/clientes', {
                templateUrl: 'pages/admin/lista-clientes.html',
                controller: 'listaClienteCtrl'
            });
//            when('/contenidos/acerca-de', {
//                templateUrl: 'pages/admin/form-contenidos.html',
//                controller: 'edicionContenidoCtrl'
//            }).
//            when('/contenidos/guia-de-uso', {
//                templateUrl: 'pages/admin/form-contenidos.html',
//                controller: 'edicionGuiaCtrl'
//            }).
//            when('/contenidos/terminos', {
//                templateUrl: 'pages/admin/form-contenidos.html',
//                controller: 'edicionminosTerCtrl'
//            }).
//            when('/contenidos/avisos', {
//                templateUrl: 'pages/admin/form-contenidos.html',
//                controller: 'edicionAvisoCtrl'
//            })
            ;
});
