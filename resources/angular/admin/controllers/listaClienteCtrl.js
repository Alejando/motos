glimglam.controller('listaClienteCtrl', function ($scope, $routeParams, User, DTOptionsBuilder, DTColumnBuilder) {
        $scope.$parent.subSeccion = "Listado de clientes registrados";


    var status = $routeParams.status;
    var self = this;
    var btnsOptions = false;

    
    if($scope["fn_" + status]){
        $scope["fn_" + status]();
    }
    $scope.allAuctions = [];
    
    $scope.dtOptions = DTOptionsBuilder.fromSource(User.getURLForAllDataTables())
        .withOption('stateSave', true)
        .withOption('scrollX', true)
        .withPaginationType('full_numbers');
    $scope.dtColumns = [];
    
    $scope.dtColumns.push(DTColumnBuilder.newColumn('id').withTitle('ID'));
    if(btnsOptions){
        var builder = DTColumnBuilder.newColumn(null).renderWith(btnsOptions).withTitle("Opciones");
        $scope.dtColumns.push(builder);
    }
    
    var getRandomInt = function(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    };
    
    $scope.dtColumns.push(DTColumnBuilder.newColumn('name').withTitle('Nombre')),
//    $scope.dtColumns.push(DTColumnBuilder.newColumn('email').withTitle('email')),
    $scope.dtColumns.push(DTColumnBuilder.newColumn(false).renderWith(function(){
        return getRandomInt(0,30);
    }).withTitle('Subastas Compradas'));
    $scope.dtColumns.push(DTColumnBuilder.newColumn(false).renderWith(function(){
        return getRandomInt(0,30);
    }).withTitle('Subastas Ganadas'));
    
//        DTColumnBuilder.newColumn('lastName').withTitle('Last name').notVisible()
    
    $scope.newSource = User.getURLForAllDataTables();
//    Auction.getAllForDataTables().then(function(datos){
//        console.log("datos", datos);
//    });

        
        
        
        
        
        
        
        
        
        
});