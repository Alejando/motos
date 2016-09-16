setpoint.controller('CatalogCtrl', function ($scope,$routeParams) {
    $scope.catalog = $routeParams.catalog; 
//    console.log("mainController");
    $scope.showForm = true;
    $scope.form = laroute.route('page',{view : 'form-talla'})
});