setpoint.controller('ContentCtrl', function($scope, $q, $http, $routeParams, Content, $timeout) {
    switch ($routeParams.content) {
        case 'nosotros':
            $scope.content = 'Nosotros';
            $scope.id = 1;
            $scope.alerta = false;
            break;
        case 'preguntas-frecuentes':
            $scope.content = 'Preguntas Frecuentes';
            $scope.id = 2;
            $scope.alerta = false;
            break;
        case 'aviso-de-privacidad':
            $scope.content = 'Aviso de privacidad';
            $scope.id = 3;
            $scope.alerta = false;
            break;
        // case 'terminos-y-condiciones':
        //     $scope.content = 'Terminos y condiciones';
        //     $scope.id = 4;
        //     break;
        // case 'condiciones-de-envio':
        //     $scope.content = 'Condiciones de envío';
        //     $scope.id = 5;
        //     break;
        // case 'condiciones-de-retorno':
        //     $scope.content = 'Condiciones de retorno';
        //     $scope.id = 6;
        //     break;
        // case 'protecion-de-datos':
        //     $scope.content = 'Proctección de datos';
        //     $scope.id = 7;
        //     break;
        default:
            $scope.content = 'Contenido';
    }
    $scope.objContent=null;
    Content.getById($scope.id).then(function(content){
        $scope.objContent = content;
        $scope.objContent.backup();
    });

    $scope.cancel = function () {
        $scope.objContent.rollback();
    }
    
    $scope.saveContent = function() {
        $scope.objContent.save();
        $scope.alerta = true;
        $timeout(function () {
            $scope.alerta = false;
        }, 2000);
    };

    $scope.tinymceOptions = {
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    };
    //    console.log("mainController");
});