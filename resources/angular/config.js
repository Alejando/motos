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
        ['/catalogos/:catalog', 'catalog', 'Catalog'],
        ['/contenidos/:content', 'content-form', 'Content'],
        ['/configuracion/:config', 'config', 'Config']
    ]);
});