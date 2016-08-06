glimglam.controller('subastasCtrl', function ($scope, $routeParams, Auction, DTOptionsBuilder, DTColumnBuilder) {
    var status = $routeParams.status;
    var self = this;
    var btnsOptions = false;
    $scope['fn_en-proceso'] = function () {
        $scope.$parent.subSeccion = "Subastas en proceso";
        console.log("as");
    };
    $scope['fn_terminadas'] = function () {
        $scope.titulo = "Terminados";
        $scope.$parent.subSeccion = "Subastas terminadas";
       
    };
    $scope['fn_sin-publicar'] = function () {
        $scope.titulo = "No publicadas";
        $scope.$parent.subSeccion = "Subastas sin publicar";  
        btnsOptions = function() {
            return "<button class=\"btn btn-primary\">Publicar</button>";
        };
    };
    
    if($scope["fn_" + status]){
        $scope["fn_" + status]();
    }
    $scope.allAuctions = [];
    
//    Auction.getAll().then(function(allAuctions){
//        $scope.allAuctions = allAuctions;
//    });
    
    $scope.dtOptions = DTOptionsBuilder.fromSource(Auction.getURLForAllDataTables())
        .withOption('stateSave', true)
        .withOption('scrollX', true)
        .withPaginationType('full_numbers');
    $scope.dtColumns = [];
    
    $scope.dtColumns.push(DTColumnBuilder.newColumn('id').withTitle('ID'));
    if(btnsOptions){
        var builder = DTColumnBuilder.newColumn(null).renderWith(btnsOptions).withTitle("Opciones");
        $scope.dtColumns.push(builder);
    }
    
    $scope.dtColumns.push(DTColumnBuilder.newColumn(null).renderWith(function(data, type, full){
            console.log(data, type, full);
            return '<a href="#/subasta/'+full.code+'">'+full.code+'</a>';
        }).withTitle('Código'));
    $scope.dtColumns.push(DTColumnBuilder.newColumn('startDate').withTitle('Fecha de Inicio')),
    $scope.dtColumns.push(DTColumnBuilder.newColumn('endDate').withTitle('Fecha de termino')),
    $scope.dtColumns.push(DTColumnBuilder.newColumn('title').withTitle('Titulo'));
//        DTColumnBuilder.newColumn('lastName').withTitle('Last name').notVisible()
    
    $scope.newSource = Auction.getURLForAllDataTables();
//    Auction.getAllForDataTables().then(function(datos){
//        console.log("datos", datos);
//    });
});