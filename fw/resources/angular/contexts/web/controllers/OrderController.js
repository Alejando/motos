
setpoint.controller('OrderCtrl', function (
    $scope,
    $compile,
    $q, 
    $http,
    Order,
    User, 
    Item,
    DTOptionsBuilder,
    DTColumnBuilder,
    $timeout,
    AuthSevice
    ) {

    $scope.test = "Pedidos Users";

    var user = AuthSevice.user();

    console.log(user.orders());
    console.log("direcciones");
    console.log(user.addresses());

    var url = laroute.route('user.getOrdersUser');
    console.log(url);
    $scope.items;
    $scope.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
        var defer = $q.defer();
            $http.get(url).then(function (result) {
                $scope.items = result.data;
                console.log($scope.items);
                defer.resolve(result.data);
            });
            return defer.promise;
        }).withOption('createdRow', function (row, data, dataIndex) {
                    // Recompiling so we can bind Angular directive to the DT
                    $compile(angular.element(row).contents())($scope);
                }).withOption('headerCallback', function (header) {
            if (!$scope.headerCompiled) {
                // Use this headerCompiled field to only compile header once
                $scope.headerCompiled = true;
                $compile(angular.element(header).contents())($scope);
            }
        }).withPaginationType('full_numbers').withLanguage({
                    "sEmptyTable":     "No hay datos disponibles en la tabla",
                    "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
                    "sInfoEmpty":      "Mostrando 0 a 0 de 0 elementos",
                    "sInfoFiltered":   "(filtrado de _MAX_ total elementos)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ",",
                    "sLengthMenu":     "Ver _MENU_ elementos",
                    "sLoadingRecords": "Cargando...",
                    "sProcessing":     "Procesando...",
                    "sSearch":         "Busqueda:",
                    "sZeroRecords":    "No se encontraron coincidencias",
                    "oPaginate": {
                        "sFirst":    "Primera",
                        "sLast":     "Ultima",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna ascendente",
                        "sSortDescending": ": Activar para ordenar la columna descendente"
                    }
                });

    $scope.dtColumns =   [
                       DTColumnBuilder.newColumn('created_at').withTitle('Fecha'),
                       DTColumnBuilder.newColumn('subtotal').withTitle('Subtotal'),
                       DTColumnBuilder.newColumn('tax').withTitle('Impuesto'),
                       DTColumnBuilder.newColumn('shipping').withTitle('Envio'),
                       DTColumnBuilder.newColumn('total').withTitle('Total'),
                       DTColumnBuilder.newColumn('status').withTitle('Estatus').renderWith(function(data, type, full){
                            switch(data) {
                                case 1 : return "Pagado";
                                case 2 : return "Pendiente";                             
                                case 3 : return "Cancelado";                             
                                default: return "N/A";
                            }
                        }),
                       DTColumnBuilder.newColumn('tracking_code').withTitle('Codigo de rastreo'),
                       DTColumnBuilder.newColumn('estimated_date').withTitle('Fecha estimada'),
                       DTColumnBuilder.newColumn(null).withTitle("Lista Productos").notSortable().renderWith(function(data, type, full, meta){
                           return '<a href="#" class="on-default edit-row icon icon" uib-tooltip="Editar"  ng-click="getDetails('+full.id+')"><i class="fa fa-list"></i></a>';
                       })
                   ];
     $scope.getDetails = function(id){
        Order.getItems(id).then(function(result) {
          console.log(result);
          $scope.order = result;
        }, function(error) {
          console.log(error);
        });



        var $message = $('<div>Cargando...</div>');
        BootstrapDialog.show({
            title: 'Productos del pedido',
            message: $message,
            onhide: function(dialog){
                
            },
            onhidden: function(dialog){
            }
        }); 

        $http.get(laroute.route('user.pages', {
            'view' : 'detailOrder'
        })).then(function(result){
            $message.fadeOut('slow', function(){
                var $div = $(this);
                $div.html(result.data).slideDown("slow"); 
                $content = angular.element(this).contents();
                $scope.$apply(function(){
                    $compile($content)($scope);
                });
            })
        });
     }
});
