setpoint.controller('LoginCtrl',['$scope', 'User', function($scope, User) {
        console.log(User);
    $scope.msj = "Scope"
    $scope.registrationForm = function () {
        alert("---");
    }
    $scope.login = function (){
        User.login($scope.email,$scope.password).then(function(r){
//                console.log(r);
            window.location.reload();
        }, function(data){ 
            if(data.error){ 
                $scope.error = true;
                $scope.menssage=data.message
            }
        }); 
    }
}]);