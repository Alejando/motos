setpoint.controller('RegistrationFormCtrl', [
    '$scope', 'User', 'Profile',
    function ($scope, User, Profile) {
        $scope.user = new User({});
        $scope.client = new Profile({});
        $scope.client.id = 2;
        $scope.password = '';
        $scope.submit = function(){
            $scope.user.relate('profile', $scope.client);
            console.log($scope.user);
            console.log($scope.client);
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