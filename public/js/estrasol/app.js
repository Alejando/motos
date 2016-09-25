var setpoint = angular.module('setpoint', [
    'ngRoute'
]);
//setpoint.constat('Config', {
//    DATE_FORMAT : 'dd/MMMM/yyyy', //https://docs.angularjs.org/api/ng/filter/date
//    HOUR_FORMAT : 'HH:mm:ss', 
//    DATE_SERVER_FORMAT : 'yyyy-MM-ddTHH:mm:ssZ',
//    CALENDAR_DATE_FORMAT : 'dd/MM/yyyy' //http://bootstrap-datepicker.readthedocs.org/en/stable/options.html#format
//});
 

setpoint.config(function ($routeProvider) {
    var pathAdmin = function (arrRoutes){
        angular.forEach(arrRoutes, function(route){
            var path = route[0], 
            template = 'pages/admin/'+route[1]+'.html', 
            ctrl = route[2]+'Ctrl';
            console.log(path);
            $routeProvider.when(path,{
                templateUrl : template,
                controller: ctrl
            });
        });
    };
    
    pathAdmin([
        ['/', 'welcome', 'Home'],
        ['/catalogos/:catalog', 'catalog', 'Catalog'],
        ['/contenidos/:content', 'content-form', 'Content'],
        ['/configuracion/:config', 'config', 'Config']
    ]);
});

    setpoint.controller('CatalogCtrl', function (
            $scope,
            $compile,
            $routeParams,
            $q, $http,
            Size,
            DTOptionsBuilder,
            DTColumnBuilder) {
        //<editor-fold defaultstate="collapsed" desc="catalogo de productos">
        this.productos = function () {
            $scope.catalog = "Productos";
        };
        //</editor-fold>
        //<editor-fold defaultstate="collapsed" desc="calogo de colores">
        this.colores = function () {
            $scope.catalog = "Colores";
        };
        //</editor-fold>

        //<editor-fold defaultstate="collapsed" desc="catalogo de categorias">
        this.categorias = function () {
            $scope.catalog = "Categorias";
        };
        //</editor-fold>
        //<editor-fold defaultstate="collapsed" desc="catalogo de marcas">
        this.marcas = function () {
            $scope.catalog = "Marcas";
        };
        //</editor-fold>        
        //<editor-fold defaultstate="collapsed" desc="catalogo de tallas">
        this.tallas = function () {
            $scope.selectedItem = new Size({});
            $scope.selectedItem.name = "XL";
//            $scope.selectedItem.id=false;
//            $scope.selectedItem.save();     
            console.log(Size);

        };
        //</editor-fold>
        $scope.saveItem = function () {
            $scope.selectedItem.save().then(function () {
                console.log("se guardo");
                $scope.showForm = false;
                $scope.selectedItem = newObj();
            });
        };

        $scope.newItem = function () {
            $scope.showForm = true;
            $scope.selectedItem = newObj();
        };

        $scope.cancel = function () {
            $scope.showForm = false;
            $scope.selectedItem = newObj();
        };

        var newObj = function () {
            var prototipes = {
                'tallas': Size
            };
            return new prototipes[$scope.catalog]({});
        };
        $scope.catalog = $routeParams.catalog;
        $scope.showForm = true;
        $scope.form = laroute.route('page', {view: 'form-' + $scope.catalog});

        $scope.selected = {};
        $scope.selectAll = false;

        $scope.toggleAll = function (selectAll, selectedItems) {
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    selectedItems[id] = selectAll;
                }
            }
        };
        $scope.toggleOne = function (selectedItems) {
            console.log($scope.items=[]);
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    if (!selectedItems[id]) {
                        $scope.selectAll = false;
                        return;
                    }
                }
            }

            $scope.selectAll = true;
        };

        $scope.items;
        var url = laroute.route('size.all-for-datatables');
        $scope.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
            var defer = $q.defer();
            $http.get(url).then(function (result) {
                $scope.items = result.data;
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
        })
                .withPaginationType('full_numbers');

        var titleHtml = '<input type="checkbox" ng-model="selectAll" ng-click="toggleAll(selectAll, selected)">';
        $scope.dtColumns = [
            DTColumnBuilder.newColumn(null).withTitle(titleHtml).notSortable()
                    .renderWith(function (data, type, full, meta) {
                        $scope.selected[full.id] = false;
                        return '<input type="checkbox" ng-model="selected[' + data.id + ']" ng-click="toggleOne(selected)">';
                    }),
            DTColumnBuilder.newColumn('id').withTitle('ID'),
            DTColumnBuilder.newColumn('name').withTitle('Name')
        ];
        this[$scope.catalog]();
    });
}();
setpoint.controller('ContentCtrl', function ($scope,$routeParams) {
    switch($routeParams.content){
        case 'nosotros':
            $scope.content = 'Nosotros';
            break;
        case 'ventajas':
            $scope.content = 'Ventajas';
            break;
        case 'formas-de-pago':
            $scope.content = 'Formas de pago';
            break;
        case 'terminos-y-condiciones':
            $scope.content = 'Terminos y condiciones';
            break;
        case 'condiciones-de-envio':
            $scope.content = 'Condiciones de envío';
            break;
        case 'ccondiciones-de-retorno':
            $scope.content = 'Condiciones de retorno';
            break;
        case 'protecion-de-datos':
            $scope.content = 'Proctección de datos';
            break;
        default:  $scope.content =  'Contenido';
    } 
//    console.log("mainController");    
});
setpoint.controller('HomeCtrl', function ($scope) {
    $scope.msj = "Bienvenido ";    
//    console.log("mainController") ;    
});
setpoint.controller('MainCtrl', function ($scope) {
//    $scope.mensaje = "hola mundo"; 
//    console.log("mainController");    
});


//# sourceMappingURL=app.js.map
