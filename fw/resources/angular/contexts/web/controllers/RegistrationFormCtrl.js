setpoint.controller('RegistrationFormCtrl', [
    '$scope', 'User',
    function ($scope, User) {
        $scope.user = new User({});
        $scope.password = '';
        $scope.submit = function(){
            $scope.user.save().then(function(r){
                if(r.success) {
                    User.login($scope.user.email,$scope.password).then(function(){
                        window.open(laroute.route('cart.shiping'),'_self');
                    });
                }
            });
        }
        
    }
]);