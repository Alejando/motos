!function () { 

    setpoint.controller('CatalogCtrl', function (
            $scope,
            $compile,
            $routeParams,
            $q, $http,
            Size,
            Color,
            Brand,
            Product,
            Category,
            DTOptionsBuilder,
            DTColumnBuilder) {
        var getTitle = function () {
            return "Titulo Por defecto";
        };
        var getColumnBuilder = [];
        //<editor-fold defaultstate="collapsed" desc="catalogo de productos">
        this.productos = function () {
            $scope.catalog = "Productos";
            $scope.model = Product;
        };
        //</editor-fold>
        //<editor-fold defaultstate="collapsed" desc="catalogo de colores">
        this.colores = function () {
            $scope.catalog = "Colores";
            $scope.model = Color;
            $scope.colorPickerOptions = {
                'format' : 'hex',
                'alpha' : false,
                'swatchBootstrap' : false
            };
            getTitle = function(){
                return $scope.selectedItem.id ? 'Edicion del color ' + $scope.selectedItem.name : 'Color Nuevo';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder
                                .newColumn(null)
                                .withTitle("Color")
                                .withOption('width', '10px')
                                .notSortable()
                                .renderWith(function(data,type,full, meta){
                                   return '<div style="width: 20px;height: 20px;display: block;background-color:' + full.rgb + ';margin: 0 auto;"> </div>'; 
                                }),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn('pref').withTitle('Prefijo'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
                                '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
                                '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
        };
        //</editor-fold>

        //<editor-fold defaultstate="collapsed" desc="catalogo de categorias">
        this.categorias = function () {
            $scope.catalog = "Categorias";
            $scope.model = Category;
            getTitle = function() {
                return $scope.selectedItem.id ? 'Edición de la "' + $scope.selectedItem.name + '"' : 'Talla Marca';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
        };
        //</editor-fold>
        //<editor-fold defaultstate="collapsed" desc="catalogo de marcas">
        this.marcas = function () {
            $scope.catalog = "Marcas";
            $scope.model = Brand;
            $scope.colorPickerOptions = {
                'format' : 'hex',
                'alpha' : false,
                'swatchBootstrap' : false
            };
            getTitle = function() {
                return $scope.selectedItem.id ? 'Edición de la "' + $scope.selectedItem.name + '"' : 'Talla Marca';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
            
        };
        //</editor-fold>        
        //<editor-fold defaultstate="collapsed" desc="catalogo de tallas">
        this.tallas = function () {
            $scope.selectedItem = new Size({});
            $scope.selectedItem.name = "XL";
            $scope.model = Size;
            getTitle = function(){
                return $scope.selectedItem.id ? 'Edición de Talla "' + $scope.selectedItem.name + '"' : 'Talla Nueva';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Name'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
                                '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
                                '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
        };
        //</editor-fold>
        $scope.saveItem = function ($event) {
            $scope.selectedItem.save().then(function () {
                var $dialog = $($event.target).closest('.modal');
                $dialog.modal('hide');
                $scope.selectedItem = newObj();
                $scope.dtInstance.reloadData(function(){
                }, !true);
            });
        };
        $scope.showFormDialog = function(){
            var $message = $('<div>Cargando...</div>');
            var defer = $q.defer();
            BootstrapDialog.show({
                title: getTitle(),
                message: $message
            });
            console.log(getTitle());
            $.get($scope.form,{},'html').done(function(txt){
                $message.fadeOut('fast', function(){ 
                    $(this).html(txt).slideDown('slow');
                    $compile(angular.element($message).contents())($scope);
                    defer.resolve();
                });
            });
            return defer.promise;
        };
        
        $scope.newItem = function () {
            $scope.selectedItem = newObj();
            $scope.showFormDialog().then(function(){});    
        };

        $scope.cancel = function ($event) {
            var $dialog=$($event.target).closest('.modal');
            $dialog.modal('hide');
            $scope.selectedItem = newObj();
        };
        
        $scope.editItem = function (id,e) {
            $scope.model.getById(id).then(function(size){
                 $scope.selectedItem = size;
                 $scope.showFormDialog();
            });
            e.preventDefault();
        };
        
        var newObj = function () {
            
            return new $scope.model({});
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
        $scope.removeItem = function (id,$event) {
            $event.preventDefault();
            $scope.model.getById(id).then(function(item){
                $scope.selectedItem = item;
                BootstrapDialog.show({
                    message: 'Deseas eliminar el color',
                    buttons: [{
                        label: 'SI',
                        cssClass: 'btn btn-primary waves-effect waves-light',
                        action: function(dialogRef) {
                            $scope.selectedItem.remove().then(function(){
                                $scope.dtInstance.reloadData(function(){
                                    $.noop();
                                }, !true);
                                dialogRef.close();
                            });
                            dialogRef.setClosable(false);
                        }
                    }, {
                        label: 'NO',
                        cssClass: 'btn btn-danger waves-effect waves-light',
                        action: function(dialogRef){
                            dialogRef.close();
                        }
                    }]
                });
            });
        };
        $scope.toggleOne = function (selectedItems) {
            console.log($scope.items);
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
        this[$scope.catalog]();
        var url = laroute.route($scope.model.alias+'.all-for-datatables');
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
        }).withPaginationType('full_numbers');
        $scope.dtInstance = {};                
        $scope.dtColumns = getColumnBuilder();
    });
}();
