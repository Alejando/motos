glimglam.controller('public.profileCtrl', function ($scope, User) {
    User.getAuthUser().then(function(user){
        console.log(user);
        $scope.user=user;
        console.log(user.gender);
    });
});