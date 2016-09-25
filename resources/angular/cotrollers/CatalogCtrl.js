!function () {

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