setpoint.controller('ContentCtrl', function($scope, $routeParams) {
    switch ($routeParams.content) {
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
        case 'condiciones-de-retorno':
            $scope.content = 'Condiciones de retorno';
            break;
        case 'protecion-de-datos':
            $scope.content = 'Proctección de datos';
            break;
        default:
            $scope.content = 'Contenido';
    }

    //////////// TinyMCE Test
    //$scope.tinymceModel = 'Initial content';

    /*$scope.getContent = function() {
        console.log('Editor content:', $scope.tinymceModel);
    };*/

    /*$scope.setContent = function() {
        $scope.tinymceModel = 'Time: ' + (new Date());
    };*/

    $scope.saveContent = function() {
        console.log($scope.tinymceModel);
    };

    $scope.tinymceOptions = {
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    };
    //    console.log("mainController");
});