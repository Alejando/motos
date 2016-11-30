setpoint.controller('LoginCtrl',['$scope', 'User', function($scope, User) {
    $scope.msj = "Scope";
    $scope.login = function (){
        if(!$scope.formLogin.invalid){
            User.login($scope.email,$scope.password).then(function(r) {
                window.location.reload();
            }, function(data){ 
                if(data.error){ 
                    $scope.error = true;
                    $scope.menssage=data.message
                }
            }); 
        }        
    }
    $('.login-form').slideDown("fast");
    
}]);