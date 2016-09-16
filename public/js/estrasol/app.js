setpoint.controller('CatalogCtrl', function ($scope,$routeParams) {
    $scope.catalog = $routeParams.catalog; 
//    console.log("mainController");
    $scope.showForm = true;
    $scope.form = laroute.route('page',{view : 'form-talla'})
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
//# sourceMappingURL=app.js.map
