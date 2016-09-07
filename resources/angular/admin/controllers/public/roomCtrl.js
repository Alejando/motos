glimglam.controller('public.roomCtrl', function ($scope, Auction, $interval, $element,$compile) {
    $scope.id_user = window.id_user;
    $scope.objAuction = new Auction(auction);
    $scope.totalBids = 0;
    $scope.nextBid = new Date();
    $('.section-room').fadeIn('slow');      
    $interval(function() {
        $scope.now = new Date();
    }, 100);
    $interval(function() {
        $socpe.checkFaults();
        $scope.getInfo();
    }, 10000);
    $scope.rangeOferta = {
         min: 0,
         max: $scope.objAuction.min_offer,
         limitMax: $scope.objAuction.max_offer,
         limitMin: $scope.objAuction.min_offer
    };
    $scope.help = {
        nextBid : new Date()
    };
    $scope.getInfo = function (){
        $scope.objAuction.getInfoBid().then(function(info){
                console.log(info);
                $scope.nextBid = new Date(info.nextbid);
                $scope.help.nextBid = $scope.nextBid.getTime();
                $scope.totalBids = info.totalbids;
                $scope.totalFaults = info.faults;
                $scope.unqualified = info.unqualified;
                $element.find('.delay-bid').empty().append('<timer interval="1000" language="es"  class="subasta-tiempo" '+
                                  '  end-time="nextBid">' +
                                      '  <small>Puedes ofertar en</small><br><span ng-show="minutes">{{minutes}} min, </span>{{seconds}} seg '+
                                "</timer>");
                $compile($element.find('.delay-bid'))($scope);
            });
    };
    $scope.getInfo();
    $scope.placeBid = function(){
        $scope.objAuction.placeBid($scope.rangeOferta.max).then(function(data) {
            $scope.objAuction.refresh();
            $scope.getInfo();
        });
    };
    $scope.objAuction.selfUpdate(1000, $scope);
});