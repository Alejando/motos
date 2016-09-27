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
            $scope.model = Size;
//            $scope.selectedItem.id=false;
//            $scope.selectedItem.save();     
            console.log(Size);

        };
        //</editor-fold>
        $scope.saveItem = function ($event) {
            console.log($scope.selectedItem);
            $scope.selectedItem.save().then(function () {
                var $dialog=$($event.target).closest('.modal');
                $dialog.modal('hide');
                $scope.selectedItem = newObj();
                $scope.dtInstance.reloadData(function(){console.log("reload");}, !true);
            });
        };
        $scope.showFormDialog = function(){
            var $message = $('<div>Cargando...</div>');
            var defer = $q.defer();
            var title = $scope.selectedItem.id?'Edicion de Talla' : 'Talla Nueva';
            BootstrapDialog.show({
                title: title,
                message: $message
            });
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
                                    console.log("RIP");
                            });
                                console.log($scope.selectedItem);
                            
                            dialogRef.setClosable(true);
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
        }).withPaginationType('full_numbers');
        $scope.dtInstance = {};
        var titleHtml = '<input type="checkbox" ng-model="selectAll" ng-click="toggleAll(selectAll, selected)">';
        $scope.dtColumns = [
            DTColumnBuilder.newColumn(null).withTitle(titleHtml).notSortable()
                    .renderWith(function (data, type, full, meta) {
                        $scope.selected[full.id] = false;
                        var options = '<input type="checkbox" ng-model="selected[' + data.id + ']" ng-click="toggleOne(selected)">';                               
                        return options;
                    }), 
            DTColumnBuilder.newColumn('id').withTitle('ID'),
            DTColumnBuilder.newColumn('name').withTitle('Name'),
            DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
                    '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
                    '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                    '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
            })
        ];
        this[$scope.catalog]();
    });
}();