glimglam.controller('subastasCtrl', function ($scope, $routeParams, Auction) {
    var status = $routeParams.status;
    console.log(status);
    var self = this;
    $scope['fn_en-proceso'] = function () {
        $scope.$parent.subSeccion = "Subastas en proceso";
        console.log("as");
    };
    $scope['fn_terminadas'] = function () {
        $scope.titulo = "Terminados";
        $scope.$parent.subSeccion = "Subastas terminadas";
        console.log("ok");
    };
    if($scope["fn_" + status]){
        $scope["fn_" + status]();
    }
    $scope.allAuctions = [];
    Auction.getAll().then(function(allAuctions){
        $scope.allAuctions = allAuctions;
    });
});