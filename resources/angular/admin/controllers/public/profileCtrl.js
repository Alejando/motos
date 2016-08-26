glimglam.controller('public.profileCtrl', function ($scope, User) {
    
    User.getById(5).then(function(user){
        console.log(user);
        $scope.user=user;
        console.log(user.gender);
    });
    $scope.message='Hoa';
});