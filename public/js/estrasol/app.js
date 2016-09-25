var setpoint = angular.module('setpoint', [
    'ngRoute'
]);
//setpoint.constat('Config', {
//    DATE_FORMAT : 'dd/MMMM/yyyy', //https://docs.angularjs.org/api/ng/filter/date
//    HOUR_FORMAT : 'HH:mm:ss', 
//    DATE_SERVER_FORMAT : 'yyyy-MM-ddTHH:mm:ssZ',
//    CALENDAR_DATE_FORMAT : 'dd/MM/yyyy' //http://bootstrap-datepicker.readthedocs.org/en/stable/options.html#format
//});
 

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

setpoint.controller('CatalogCtrl', function ($scope,$routeParams) {
    $scope.catalog = $routeParams.catalog; 
//    console.log("mainController");
    $scope.showForm = true;
    $scope.form = laroute.route('page',{view : 'form-talla'})
});
setpoint.controller('ConfigCtrl', function ($scope, $routeParams) {
    $scope.msj = $routeParams.config; 
//    console.log("mainController");    
});
setpoint.controller('ContentCtrl', function ($scope,$routeParams) {
    switch($routeParams.content){
        case 'nosotros':
            $scope.content = 'Nosotros';
            break;
        case 'ventajas':
            $scope.content = 'Ventajas';
            break;
        case 'formas-de-pago':
            $scope.content = 'Formas de pago';
            break;
        case 'terminos-y-condiciones':
            $scope.content = 'Terminos y condiciones';
            break;
        case 'condiciones-de-envio':
            $scope.content = 'Condiciones de envío';
            break;
        case 'ccondiciones-de-retorno':
            $scope.content = 'Condiciones de retorno';
            break;
        case 'protecion-de-datos':
            $scope.content = 'Proctección de datos';
            break;
        default:  $scope.content =  'Contenido';
    } 
//    console.log("mainController");    
});
setpoint.controller('HomeCtrl', function ($scope) {
    $scope.msj = "Bienvenido ";    
//    console.log("mainController") ;    
});
setpoint.controller('MainCtrl', function ($scope) {
//    $scope.mensaje = "hola mundo"; 
//    console.log("mainController");    
});


//# sourceMappingURL=app.js.map
