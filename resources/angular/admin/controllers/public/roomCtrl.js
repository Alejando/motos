glimglam.controller('public.roomCtrl', function ($scope, Auction) {
    $scope.objAuction = new Auction(auction);
    console.log($scope.objAuction );
    $scope.rangeOferta = {
         min: 0,
         max: $scope.objAuction.min_offer,
         limitMax: $scope.objAuction.max_offer,
         limitMin: $scope.objAuction.min_offer
    };
    $scope.placeBid = function(){
        $scope.objAuction.placeBid().then(function(data) {
            $scope.objAuction.refresh();
        });
    };
    $scope.objAuction.selfUpdate(1000, $scope);
});