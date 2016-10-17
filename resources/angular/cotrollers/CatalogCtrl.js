/* global BootstrapDialog, setpoint */

!function () { 

    setpoint.controller('CatalogCtrl', function (
            $scope,
            $compile,
            $routeParams,
            $q, $http,
            Size,
            Color,
            Brand,
            User,
            Stock,
            Product,
            Category,
            DTOptionsBuilder,
            DTColumnBuilder,
            $interval,
            $timeout
            ) {
        var getTitle = function () {
            return "Titulo Por defecto";
        };
        var getColumnBuilder = [];
        //<editor-fold defaultstate="collapsed" desc="catalogo de productos">
        this.productos = function () {
            $scope.catalog = "Productos";
            $scope.model = Product;
            getTitle = function(){
                return $scope.selectedItem.id ? 'Edición del producto ' + $scope.selectedItem.name : 'Nuevo producto';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type, full, meta){
                            return '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
            $scope.brands = [];
            $scope.selectedBrand = null;
            Brand.getAll().then(function(brands) {
                $scope.brands = brands;
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
//                console.log($scope.selectedBrand);
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
                                   return '<div class="box-color" style="background-color:' + full.rgb + ';"> </div>'; 
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
        //<editor-fold defaultstate="collapsed" desc="catalogo de usuarios">
        this.usuarios = function () {
            $scope.catalog = "usuarios";
            $scope.prepareItem = function () {}
            $scope.model = User;
            getTitle = function (){
                return $scope.selectedItem.id ? 'Edición del usuario "' + $scope.selectedItem.name + '"' : 'Nuevo Usuario';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn('email').withTitle('Email'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
        }
        //</editor-fold>
        //<editor-fold defaultstate="collapsed" desc="catalogo de stock">
        this.stock = function () {
            $scope.catalog = "Stock";
            $scope.hideExcelExport = true;
            $scope.hideExcelImport = true;
            $scope.prepareItem = function () {
                $scope.selectedItem.relate('product', $scope.selectedProduct);
                $scope.selectedItem.relate('color', $scope.selectedColor);
                $scope.selectedItem.relate('size', $scope.selectedSize);
            };
            $scope.model = Stock;
            $scope.products = [];
            Product.getAll().then(function(products) {
                console.log(products);
                $scope.products = products;
            });
            $scope.colors = [];
            
            $scope.selectedProduct = null;
            $scope.selectedColor = null;
            $scope.selectedSize = null;
            $scope.onSelectProduct = function() {
                var def = $q.defer();
                var loadColors = $scope.selectedProduct.colors().then(function(colors) {
                    $scope.colors = colors;
                });
                var loadProduct = $scope.selectedProduct.sizes().then(function(sizes) {
                    $scope.sizes = sizes;
                });
                $q.all([loadColors, loadProduct]).then(function() {
                    def.resolve();
                });
                return def.promise;
            };
            $scope.preprareForm = function() {
                var def = $q.defer();
                if($scope.selectedItem.id) {
                    $scope.selectedItem.backup();
                    var loadProduct = $scope.selectedItem.product();
                    var loadColor = $scope.selectedItem.color();
                    var loadSize = $scope.selectedItem.size();
                    $q.all([loadProduct,loadColor,loadSize]).then(function(d) {
                        $scope.selectedProduct = d[0];
                        $scope.selectedColor = d[1];
                        $scope.selectedSize = d[2];
                        $scope.onSelectProduct().then(function() {
                            def.resolve();
                        });
                    });
                } else {
                    $timeout(function() {
                        $scope.selectedProduct = null;
                        $scope.selectedColor = null;
                        $scope.selectedSize = null;
                        def.resolve();
                    },10);
                }
                return def.promise;
            }
            $scope.size = [];
            getTitle = function () {
                return $scope.selectedItem.id ? 'Edición del stock"' + $scope.selectedItem.code + '"' : 'Nuevo Stock';
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('code').withTitle('Código'),
                        DTColumnBuilder.newColumn('product.name').withTitle('Producto'),
                        DTColumnBuilder.newColumn('quantity').withTitle('Existencias'), 
                        DTColumnBuilder.newColumn('size.name').withTitle('Tamaño/Talla'),
                        DTColumnBuilder.newColumn('color.name').withTitle('Color').renderWith(function(data, type, full, meta){
                            return  '<div class="box-color" style="background-color:' + full.color.rgb + ';"></div>' +
                                    '<div style="text-align:center">' + full.color.name + '</div>';
                        }),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row" ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
        }
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
            $scope.prepareItem = function(){
                $scope.selectedItem.addFile('icon', $scope.icon);
//                console.log($scope.selectedItem);
            };
            $scope.model = Brand;
            $scope.colorPickerOptions = {
                'format' : 'hex',
                'alpha' : false,
                'swatchBootstrap' : false
            };
            $scope.icon = null;
            $scope.imgICon = null;
            $scope.iconSrc =  '';
            $scope.onselectIcon = function(changeEvent, files){
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    $scope.$apply(function () {
                        $scope.iconSrc = loadEvent.target.result;
                    });
                };
                reader.readAsDataURL(changeEvent.target.files[0]);
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
            if($scope.prepareItem){
                $scope.prepareItem();
            }
            $scope.selectedItem.save().then(function () {
                 $scope.selectedItem.backup();
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
                message: $message,
                onhide: function(dialog){
                    $scope.selectedItem.rollback();
                    $scope.selectedItem = newObj();
                }
            });
            $.get($scope.form,{},'html').done(function(txt){
                $message.fadeOut('fast', function(){ 
                    if($scope.preprareForm) {
                        var self = this;
                        $scope.preprareForm().then(function(){
                            $(self).html(txt).slideDown('slow');
                            $compile(angular.element($message).contents())($scope);
                            defer.resolve();
                        });
                    } else {
                        $(this).html(txt).slideDown('slow');
                        $compile(angular.element($message).contents())($scope);
                        defer.resolve();
                    }
                });
            });
            return defer.promise;
        };
        
        $scope.newItem = function () {
            $scope.selectedItem = newObj();
            $scope.showFormDialog().then(function(){});    
        };

        $scope.cancel = function ($event) {
            $event.preventDefault();
            var $dialog=$($event.target).closest('.modal');
            $dialog.modal('hide');
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
