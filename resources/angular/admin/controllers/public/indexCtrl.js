glimglam.controller('public.IndexCtrl', function ($scope, Auction) {
    $scope.titulo = "Hello";
    window.Auction = Auction;
    Auction.getAll().then(function(all) {
        console.log(all);
    });
//    Auction.getByCode("SUB001").then(function(byCode) {
//        console.log("Auction byCode=> %o", byCode);
//        console.log("cover horizontal => %o", byCode.getUrlCover(Auction.COVER_HORIZOTAL));
//        console.log("cover vertical => %o", byCode.getUrlCover(Auction.COVER_VERTICAL));
//        console.log('cover slider => %o',  byCode.getUrlCover(Auction.COVER_SLIDER_UPCOMING));
//    });
//    Auction.getUpcoming(10).then(function(auctions) {
//        console.log('diez proximas => %o', auctions);
//    });
//    Auction.getFinished(10).then(function(auctions) {
//        console.log('las ultimas 10 terminadas => %o', auctions);
//    });
//    Auction.getStarted(10).then(function(auctions){
//        console.log('las ultimas iniciadas => %o', auctions);
//    });
    
    $scope.lastStarted = null;
    
    Auction.getStarted(1).then(function(auction) {
        $scope.lastStarted = auction[0];
        $scope.lastStarted.selfUpdate(1500000, $scope);    
    });
    $scope.$parent.subSeccion = "Actualización Masiva";
});