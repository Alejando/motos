glimglam.controller('public.IndexCtrl', function ($scope, Auction) {
    $scope.titulo = "Hello";
    window.Auction = Auction;
    Auction.getAll().then(function(all) {
        console.log(all);
    });
    Auction.getByCode("SUB-001").then(function(byCode) {
        console.log("Auction byCode=> %o", byCode);
        console.log("cover horizontal => %o", byCode.getUrlCover(Auction.COVER_HORIZOTAL));
        console.log("cover vertical => %o", byCode.getUrlCover(Auction.COVER_VERTICAL));
        console.log('cover slider => %o',  byCode.getUrlCover(Auction.COVER_SLIDER_UPCOMING));
    });
    Auction.getUpcoming(10).then(function(auctions) {
        console.log('diez proximas => %o', auctions);
    });
    Auction.getPage().then(function(result) {
        console.log(result);
    });
    console.log("controlador Index");
    $scope.$parent.subSeccion = "Actualización Masiva";
});