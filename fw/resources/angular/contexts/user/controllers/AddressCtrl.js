!function() {
setpoint.controller('AddressCtrl', function (
    $scope,
    $compile,
    $routeParams,
    $q, $http,
    Product,
    DTOptionsBuilder,
    DTColumnBuilder,
    $interval,
    $timeout
    ) {
    var getTitle = function () {
        return "Titulo Por defecto";
    };
    var getRemoveTitle = function() {
        return "Título por defecto";
    };
    var getColumnBuilder = [];

    // hide export/import buttons by default
    $scope.hideExcelExport = true;
    $scope.hideExcelImport = true;

    //<editor-fold defaultstate="collapsed" desc="catalogo de productos">
    this.productos = function () {
        $scope.catalog = "Productos";
        $scope.model = Product;
        getTitle = function(){
            return $scope.selectedItem.id ? 'Edición del producto ' + $scope.selectedItem.name : 'Nuevo producto';
        };
        getRemoveTitle = function() {
            return "¿Seguro que desea eliminar el producto'" + $scope.selectedItem.name + "' ?";
        };
        getColumnBuilder = function () {
            return [
                    DTColumnBuilder.newColumn('id').withTitle('ID'),
                    DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                    DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type, full, meta){
                        return '<a href="#" class="on-default edit-row icon icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                            '<a href="#" class="on-default remove-row icon icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                    })
                ];
        };
        $scope.brands = [];
        $scope.selectedBrand = null;
        Brand.getAll().then(function(brands) {
            $scope.brands = brands;
            $('[data-toggle="tooltip"]').tooltip();
        });
        $scope.addColor = function ($event, color) {
            $event.target.checked;
            if($scope.selectedItem) {
                if($event.target.checked) {
                    $scope.selectedItem.relate('colors', color);
                } else {
                    $scope.selectedItem.detach('colors', color);
                }
            }
        };
        $scope.inColors = function(color) {
            if($scope.selectedItem && $scope.selectedItem.colors_ids) {
                return $scope.selectedItem.colors_ids.indexOf(color.id) !== -1;
            }
        };
        $scope.inSizes = function(size) {
            if($scope.selectedItem && $scope.selectedItem.sizes_ids) {
                return $scope.selectedItem.sizes_ids.indexOf(size.id) !== -1;
            }
        };
        $scope.addSize = function ($event, size) {
            $event.target.checked;
            if($scope.selectedItem) {
                if($event.target.checked) {
                    $scope.selectedItem.relate('sizes', size);
                } else {
                    $scope.selectedItem.detach('sizes', size);
                }
            }
        };
        $scope.inSize = function(size) {
            if($scope.selectedItem && $scope.selectedItem.sizes_ids) {
                return $scope.selectedItem.sizes_ids.indexOf(size.id) !== -1;
            }
        };
        $scope.prepareItem = function () {
            var $jstree = $('.div-js-tree js-tree');
            var checkeds = $jstree.jstree("get_checked",null,true);
            angular.forEach(checkeds, function(category){
                $scope.selectedItem.relate("categories", {
                    id : category
                });
            });
            $scope.selectedItem.brand_id = $scope.selectedBrand.id;
            $scope.selectedItem.multi_galeries = $scope.selectedItem.multi_galeries === true ? 1 : 0;
            angular.forEach($scope.files,function(file, i){
                $scope.selectedItem.addFile('img[' + i + ']', file);
            });
        };
        $scope.preprareForm = function () {
            $scope.files = [];
            $def = $q.defer();
            $scope.selectedItem.backup();
            $scope.selectedBrand = null;
            $scope.selectedItem.clearFiles();
            var defCategories = $scope.selectedItem.categories().then(function(categories) {
                if(categories.length) {
                   var whaitJsTree = $interval(function(){
                       var $jstree = $('.div-js-tree js-tree');
                       if($jstree.find("#" + categories[0].id).size()) {
                            $interval.cancel(whaitJsTree);
                            angular.forEach(categories, function(category) {
                                $jstree.jstree('check_node', "#" + category.id);
                            });
                        }
                    }, 10);
                }
            });
            if($scope.selectedItem.id) {
                var defLoadImg = $scope.selectedItem.getImgs();
            }
            var defLoadProductsColors = $scope.selectedItem.colors();
            var defLoadBrand = $scope.selectedItem.brand().then(function(brand){
                $scope.selectedBrand = brand;
                console.log(brand);
            });
            $scope.selectedItem.sizes();
            var defColors = Color.getAll().then(function(colores){
                $scope.colors = colores;
            });
            var defSizes = Size.getAll().then(function(sizes){
                $scope.sizes = sizes;
            });
            $q.all([defCategories, defColors, defLoadProductsColors, defLoadImg, defSizes]).then(function(){
                $def.resolve();
            });

            return $def.promise;
        };

        $scope.files = [];
        $scope.removeSelectedFile = function (file) {
            var index = $scope.files.indexOf(file);
            $scope.files.splice(index,1);
        };
        $scope.onselectfile = function(files) {
            angular.forEach(files,function(file) {
               if(file.type === "image/png" || file.type === "image/jpeg") {
                   $scope.$apply(function(){
                       $scope.files.push(file);
                   });
               }
            });
        };

        $scope.validateForm = function() {
            $scope.productForm.name.$touched =
            $scope.productForm.code.$touched =
            $scope.productForm.price.$touched = true;
            if($scope.selectedBrand===null){
                $scope.productForm.brand.$invalid = true;
                $scope.productForm.brand.$touched = true;
            }
            if(
               $scope.productForm.name.$invalid || 
               $scope.productForm.code.$invalid ||
               $scope.productForm.price.$invalid ||
               $scope.productForm.brand.$invalid
            ){
                setTimeout(function() {
                    $('.form-coupons .error:eq(0)').focus();
                },100);
                return false;
            }
        };

    };
    
});
}();