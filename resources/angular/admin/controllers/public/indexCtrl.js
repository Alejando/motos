glimglam.controller('public.IndexCtrl', function ($scope, Auction) {
    $scope.titulo = "Hello";
    window.Auction = Auction;
    Auction.getAll().then(function(all){
        console.log(all);
    });
    Auction.getByCode("SUB-001").then(function(byCode){
        console.log("Auction byCode=> %o", byCode);
        console.log("cover horizontal => %a", byCode.getCover(Auction.COVER_HORIZOTAL));
        console.log("cover vertical => %o", byCode.getCover(Auction.COVER_VERTICAL));
        console.log('cover slider => %o',  byCode.getCover(Auction.COVER_SLIDER_UPCOMING));
    });
    console.log("controlador Index");
    $scope.$parent.subSeccion = "Actualización Masiva";
});