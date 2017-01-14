setpoint.config(function ($routeProvider) {
    var pathAdmin = function (arrRoutes){
        angular.forEach(arrRoutes, function(route){
            var path = route[0], 
            template = 'pages/admin/'+route[1]+'.html', 
            ctrl = route[2]+'Ctrl';
            console.log(path);
            $routeProvider.when(path,{
                templateUrl : template,
                controller: ctrl
            });
        });
    };
    
    pathAdmin([
        ['/', 'welcome', 'Home'],
        ['/catalogos/categorias', 'categories', 'Categories'],
        ['/catalogos/:catalog', 'catalog', 'Catalog'],
        ['/contenidos/:content', 'content-form', 'Content'],
        ['/configuracion/:config', 'config', 'Config']
    ]);
});

setpoint.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);

setpoint.config(function (localStorageServiceProvider, $httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    localStorageServiceProvider
        .setPrefix('estrasol')
//        .setStorageType('sessionStorage')
    ;
});

setpoint.constant('DATE_FORMAT', 'dd/MM/yyyy');
setpoint.constant('TIME_FORMAT', 'HH:mm:ss');
setpoint.constant('DATETIME_FORMAT', 'dd/MM/yyyy HH:mm:ss');
