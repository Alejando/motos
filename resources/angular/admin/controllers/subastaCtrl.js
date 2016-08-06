glimglam.controller('subastaCtrl', function ($scope, $routeParams, Auction, $http) {
    $scope.msj = "Main Controller";
    $scope.subSeccion = false;
    $scope.auction;
    $scope.photos = [];
    
    var code = $routeParams.code;
    $scope.$parent.subSeccion="Detalle " + code;
    $scope.auction;
    Auction.getByCode(code).then(function (auction) {
        $scope.auction = auction;
    });
    return ;
    Auction.getById($routeParams.id).then(function(a){
        $scope.auction = a;
        var url = laroute.route(Auction.aliasUrl())+'/'+a.id+"/photos/";
        console.log(url);
//        return ;
        $http({
            'method' : 'GET',
//            'data' : data,
            'url' : url
        }).then(function(result) {
            $scope.photos = result.data; 
        },function(r){
           
        });
    });
});