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
            Coupon,
            Order,
            PostalCodeGroup,
            PostalCode, 
            DTOptionsBuilder,
            DTColumnBuilder,
            $interval,
            $timeout,
            $filter,
            DtDialog,
            DATETIME_FORMAT
            ) {
        $scope.DATETIME_FORMAT = DATETIME_FORMAT;
        var currency = $filter('currency');
        var date = $filter('date');
        var dtOptions = false;
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
            $scope.hideExcelExport = true;
            $scope.hideExcelImport = true;
            $scope.icon_main_banner = 'fa fa-star-o';
            getTitle = function(){
                return $scope.selectedItem.id ? 'Edición del producto ' + $scope.selectedItem.name : 'Nuevo producto';
            };
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar el producto '" + $scope.selectedItem.name + "' ?";
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type, full, meta){
                            if(full.main_banner == 1){
                                $scope.icon_main_banner = 'fa fa-star';
                            }else{
                                $scope.icon_main_banner = 'fa fa-star-o';
                            }
                            return '<a href="#" class="on-default edit-row icon icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>'+
                                '<a class="on-default remove-row icon icon warning" uib-tooltip="Destacado" ng-click="addMainBanner('+full.id+', $event)"><i class="'+$scope.icon_main_banner+'"></i></a>';
                        })
                    ];
            };
            $scope.brands = [];
            $scope.selectedBrand = null;
            Brand.getAll().then(function(brands) {
                $scope.brands = brands;
                $('[data-toggle="tooltip"]').tooltip();
            });
            $scope.defaultColor = null;
            $scope.selectDefaultColor = function() {
                $scope.selectedItem.relate('defaultColor', $scope.defaultColor);
            }
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


            $scope.import = function () {
                console.log('import');
            };
            $scope.export = function () {
                console.log("export");
            };

            $scope.addMainBanner = function (id,$event) {
                //alert(id);
                console.log("Change main banner");
                $scope.model.getById(id).then(function(product){
                    $scope.selectedItem =  product;
                    console.log($scope.selectedItem.main_banner);
                    if($scope.selectedItem.main_banner == 1){
                        $scope.selectedItem.main_banner = 0;
                    }else{
                        $scope.selectedItem.main_banner = 1;
                    }
                    $scope.selectedItem.save().then(function () {
                        $scope.selectedItem.backup();
                        $scope.dtInstance.reloadData(function(){
                        }, !true);
                    });
                });
            }

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
                return $scope.selectedItem.id ? 'Edición del color ' + $scope.selectedItem.name : 'Color Nuevo';
            };
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar el color '" + $scope.selectedItem.name + "' ?";
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
                                '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
            $scope.validateForm = function() {
                console.log("validando colores");
                $scope.colorForm.name.$touched =
                $scope.colorForm.pref.$touched =
                $scope.colorForm.rgb.$touched = true;
                if(
                   $scope.colorForm.name.$invalid || 
                   $scope.colorForm.pref.$invalid ||
                   $scope.colorForm.rgb.$invalid
                ){
                    setTimeout(function() {
                        $('.form-coupons .error:eq(0)').focus();
                    },100);
                    return false;
                }
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
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar el usuario '" + $scope.selectedItem.name + "' ?";
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn('email').withTitle('Email'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
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
                    $q.all([loadProduct, loadColor, loadSize]).then(function(d) {
                        $scope.selectedProduct = d[0];
                        $scope.selectedColor = d[1];
                        $scope.selectedSize = d[2];
                        $scope.onSelectProduct().then(function() {
                            def.resolve();
                        });
                    }).catch(function(e) {
                        console.log(e);
                        console.log("Algo no furula");
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
                return $scope.selectedItem.id ? 'Edición del stock "' + $scope.selectedItem.code + '"' : 'Nuevo Stock';
            };
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar el stock '" + $scope.selectedItem.code + "' ?";
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('code').withTitle('Código'),
                        DTColumnBuilder.newColumn('product.name').withTitle('Producto'),
                        DTColumnBuilder.newColumn('quantity').withTitle('Existencias'),
                        DTColumnBuilder.newColumn(null).withTitle('Tamaño/Talla').renderWith(function(data, type, full, meta){
                           if(full.size && full.size.name){
                               return full.size.name;
                           }
                           return "N/A";
                        }),
                        DTColumnBuilder.newColumn('color.name').withTitle('Color').renderWith(function(data, type, full, meta){
                            if(full.color && full.color.rgb) {
                                return  '<div class="box-color" style="background-color:' + full.color.rgb + ';"></div>' +
                                        '<div style="text-align:center">' + full.color.name + '</div>';
                            } else {
                                return "N/A";
                            }

                        }),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
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
                return $scope.selectedItem.id ? 'Edición de la categoría "' + $scope.selectedItem.name + '"' : 'Talla Marca';
            };
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar la categoría '" + $scope.selectedItem.name + "' ?";
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
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
                return $scope.selectedItem.id ? 'Edición de la marca "' + $scope.selectedItem.name + '"' : 'Talla Marca';
            };
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar la marca '" + $scope.selectedItem.name + "' ?";
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Nombre'),
                        DTColumnBuilder.newColumn(null).withTitle("Logo").notSortable().renderWith(function(data, type, full, meta){
                            var img = Brand.prototype.getLogo.apply(full,['100', '20']);
                            return '<img src="'+img+'">'
                        }),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return  '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                    '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
            $scope.validateForm = function() {
                console.log("validando nombre de marca");
                $scope.brandForm.name.$touched = true;

                if($scope.brandForm.name.$invalid){
                    setTimeout(function() {
                        $('.form-coupons .error:eq(0)').focus();
                    },100);
                    return false;
                }
            };
        };
        //</editor-fold>
        
        //<editor-fold defaultstate="collapsed" desc="zonas de envio">
        this.zonas = function () { 
            
            $scope.selectedItem = new PostalCodeGroup({});
            $scope.model = PostalCodeGroup;
            console.log(PostalCodeGroup);
            
            $scope.showCPFrom = function (id) {
                var url = PostalCode.urlGetAllByGroup(id);
                
                $scope.dtInstanceShippingZones = {};
                
                $scope.saveCPs = function () {
                    PostalCode.saveGroup($scope.codes, id).then(function(){
                        $scope.codes = "";
                        $scope.dtInstanceShippingZones.reloadData(function(){}, !true);
                    });
                };
                $scope.removeCP = function (id, $event) {
                    $event.preventDefault();
                    PostalCode.getById(id).then(function(cp){
                        BootstrapDialog.show({
                            message: "Deseas eliminar el codigo "+cp.code,
                            title: 'Eliminar',
                            buttons: [{
                                label: 'SI',
                                cssClass: 'btn btn-primary waves-effect waves-light',
                                action: function(dialogRef) {
                                    cp.remove().then(function(){
                                        $scope.dtInstanceShippingZones.reloadData(function(){}, !true);
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
                $scope.dtOptionsShippingZones = DTOptionsBuilder.fromFnPromise(function () {
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
               
                $scope.dtColumnsShippingZones = [ 
                    DTColumnBuilder.newColumn('id').withTitle('ID'),
                    DTColumnBuilder.newColumn('code').withTitle('C.P').renderWith(function(data, type, full){
                        return '<a href="" ng-click="showCPFrom('+full.id+')">' + data +'</a>';
                    }),
                    DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                        return  '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeCP('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                    })
                ];
                
                var $message = $('<div>Cargando...</div>');
                BootstrapDialog.show({
                    title: getTitle(),
                    message: $message,
                    onhide: function(dialog){
                        $scope.selectedItem.rollback();
                    },
                    onhidden: function(dialog){
                         //$scope.selectedItem = newObj();
                    }
                });  
                
                $.get($scope.form = laroute.route('page', {view : 'form-postal-codes'}), {}, 'html').done(function(txt) {
                    $message.fadeOut('fast', function() {
                        if($scope.preprareForm) {
                            var self = this;
                            $scope.preprareForm().then(function(){
                                $(self).html(txt).slideDown('slow');
                                $compile(angular.element($message).contents())($scope);
                               // defer.resolve();
                            });
                        } else {
                            $(this).html(txt).slideDown('slow');
                            $compile(angular.element($message).contents())($scope);
                           // defer.resolve();
                        }
                    });
                });
                
            };
            getTitle = function() {   
                return $scope.selectedItem.id ? 'Edición de la grupo de envío "' + $scope.selectedItem.name + '"' : 'Nueva Zona de envío';
            }; 
            getRemoveTitle = function () {
                return "¿Seguro que desea eliminar la zona \"" + $scope.selectedItem.name + "\"";
            };
            getColumnBuilder = function () {
                return [ 
                    DTColumnBuilder.newColumn('id').withTitle('ID'),
                    
                    DTColumnBuilder.newColumn('name').withTitle('Name').renderWith(function(data, type, full){
                        //console.log("render => ", full, data);  
                        return '<a href="" ng-click="showCPFrom('+full.id+')">' + data +'</a>';
                    }),
                    DTColumnBuilder.newColumn('price').withTitle('Precio').renderWith(function(data, type, full, meta){
                         return currency(full.price);   
                    }), 
                    DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                        return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
                            '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
                            '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                            '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                    })
                ];
            };
            $scope.validateForm = function () {
                
            };
        }
        //</editor-fold>

        //<editor-fold defaultstate="collapsed" desc="catalogo de tallas">
        this.tallas = function () {
            $scope.selectedItem = new Size({});
            $scope.selectedItem.name = "XL";
            $scope.model = Size;
            getTitle = function(){
                return $scope.selectedItem.id ? 'Edición de talla "' + $scope.selectedItem.name + '"' : 'Talla Nueva';
            };
            getRemoveTitle = function() {
                return "¿Seguro que desea eliminar la talla '" + $scope.selectedItem.name + "' ?";
            };
            getColumnBuilder = function () {
                return [
                        DTColumnBuilder.newColumn('id').withTitle('ID'),
                        DTColumnBuilder.newColumn('name').withTitle('Name'),
                        DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
                                '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
                                '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                    ];
            };
            $scope.validateForm = function() {
                console.log("validando la talla");
                $scope.sizeForm.name.$touched = true;

                if($scope.sizeForm.name.$invalid){
                    setTimeout(function() {
                        $('.form-coupons .error:eq(0)').focus();
                    },100);
                    return false;
                }
            };
        };
        //</editor-fold>
        
        //<editor-fold defaultstate="collapsed" desc="cupones">
        this.cupones = function() {
            console.log(Coupon.types);
            $scope.Coupon = Coupon;
            $scope.catalog = "Cupones";
            $scope.model = Coupon;
            $scope.products = [];
            $scope.coupontype = Coupon.types.FREE_PRODUCT_BY_AMOUNT;
            $scope.selectedProduct = null;
            $scope.stocks = null;
            Color.getAll().then(function (colors) {
                $scope.colors = colors;
            });
            Size.getAll().then(function(sizes) {
                $scope.sizes = sizes;
            });
            $scope.d = {};
            $scope.$root.selectedStock = "qm";
            $scope.loadStocks = function (product) {
                $scope.$root.selectedStock = null;
                $scope.selectedStock = null;
                if(product) {
                   product.stocks({
                       'with':[
                           'stocks.color',
                           'stocks.size'
                       ]
                   }).then(function(stocks){
                        stocks.unshift({
                                id : null,
                                code : "Cualquiera con existencia",
                        });
                        console.log(stocks);
                        $scope.stocks = stocks;
                   });
                } else {                    
                    $scope.stocks = null;
                }
            }
            Product.getAll().then(function(products) {
                $scope.products = products; 
            });
            getTitle = function () {
                return $scope.selectedItem.id?'Edición de cupón':'Nuevo Cupón';
            };
            getRemoveTitle = function () {
                return "¿Desea eliminar el cupon \""+$scope.selectedItem.code+"\"";
            };
            getColumnBuilder = function () {
                return [
                    DTColumnBuilder.newColumn('id').withTitle("ID"),
                    DTColumnBuilder.newColumn('code').withTitle("Código"),
                    DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
                            '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
                            '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                            '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                    })
                ];
            };
            $scope.types = [{
                    type : Coupon.types.PERSENT_BY_AMOUNT,
                    text : 'Porcentaje por monto minimo',
                },{
                    type : Coupon.types.DISCOUNT_BY_AMOUNT,
                    text : 'Monto por monto minimo',
                },{
                    type : Coupon.types.FREE_PRODUCT_BY_AMOUNT,
                    text : 'Producto gratis por monto minimo',
                }
            ]; 
            
            $scope.coupontype = $scope.types[1];
            $scope.slider ={
                    options: {
                        step:1,
                        floor: 0,
                        ceil: 100,
                        translate : function (v) {
                            return v!=0 ? "-" + v + '%' : v+'%';
                        }
                    }
                
            };
            $scope.datapickers = {
                'startDate' :  {
                    open : false,
                    datepickerOptions: {
                        showWeeks: false,
                        startingDay: 1,
                        minDate : new Date()
                    }
                },
                'expireDate' :  {
                    open : false,
                    datepickerOptions: {
                        showWeeks: true,
                        startingDay: 1
                    }
                }
            };
            
            $scope.preprareForm = function () {
                var defer = $q.defer();
                  // watch min and max dates to calculate difference
                var unwatchMinMaxValues = $scope.$watch(function() {
                    return [$scope.selectedItem.start_date, $scope.selectedItem.expire_date];
                }, function() {
                    $scope.datapickers.expireDate.datepickerOptions.minDate = $scope.selectedItem.start_date;
                    $scope.datapickers.startDate.datepickerOptions.maxDate = $scope.selectedItem.expire_date;
                }, true);
                
                $timeout(function() {
                    $scope.selectedItem.start_date = new Date();
                    $scope.selectedItem.expire_date = new Date();
                    defer.resolve();
                },10);
                $timeout(function() { //FIX dimensiones pra el slider
                    if(!$scope.selectedItem.id){
                        $scope.selectedItem.percent = 10;
                    }
                    $scope.$broadcast('reCalcViewDimensions');
                }, 400);
                return defer.promise;
            };
            $scope.prepareItem = function () {
                $scope.selectedItem.type = $scope.coupontype.type; 
                $scope.selectedItem.relate('product', $scope.selectedProduct);
                $scope.selectedItem.relate('stock', $scope.$root.selectedStock)
                console.log("prepare", $scope.selectedItem);
            };
            $scope.openCalendar = function(e, date) {
                e.preventDefault();
                e.stopPropagation();
                angular.forEach($scope.datapickers, function(item) {
                   item.open = false; 
                });
                $scope.datapickers[date].open = true;
            };
            $scope.validateForm = function() {
                $scope.regForm.discount.$touched =
                $scope.regForm.min_amount.$touched =
                $scope.regForm.code.$touched = true;
                if($scope.selectedItem.start_date===null){
                    $scope.regForm.startDate.$invalid = true;
                }
                if($scope.selectedItem.expire_date === null){
                    $scope.regForm.expreDate.$invalid = true;
                } 
                
                if($scope.coupontype.type == Coupon.types.DISCOUNT_BY_AMOUNT) {
                    $scope.productInvalid = false;
                }
                if($scope.coupontype.type == Coupon.types.PERSENT_BY_AMOUNT) {
                    $scope.regForm.discount.$invalid = false;
                    $scope.productInvalid = false;
                     
                }
                if($scope.coupontype.type == Coupon.types.FREE_PRODUCT_BY_AMOUNT){
                    $scope.regForm.discount.$invalid = false;
                    $scope.productInvalid = $scope.selectedProduct === null;
                }
                if(
                   $scope.regForm.code.$invalid || 
                   $scope.regForm.min_amount.$invalid ||
                   $scope.regForm.startDate.$invalid ||
                   $scope.regForm.expreDate.$invalid ||
                   $scope.regForm.discount.$invalid ||
                   $scope.productInvalid
                ){
                    setTimeout(function() {
                        $('.form-coupons .error:eq(0)').focus();
                    },100);
                    return false;
                }
            }
        };
        //</editor-fold>
        
        //<editor-fold defaultstate="collapsed" desc="pedidos">
        this.pedidos = function () {
            $scope.model = Order;
            $scope.catalog = "Ordenes";
            $scope.preprareForm = function () {};
            $scope.prepareItem = function () {};
            $scope.validateForm = function () {}; 
            $scope.setBillNumber = function (order){
                order.backup();
                DtDialog.show($scope,
                laroute.route('page',{'view':'form-set-bill'}),
                ['Factura...', 'Factura del pedido {{order.id}}'],
                undefined, [
                    {
                        label : 'Guardar',
                        cssClass: 'btn-primary',
                        action : function (dialog) {
                            order.setBillNumber(order.bill_number).then(function() {
                                order.backup();
                                dialog.close();
                            });
                        }
                    }, DtDialog.btns.cancel
                ],{
                    draggable: true,
                    onhide : function () {
                       $timeout(function() {
                            order.rollback();
                        }, 1);
                    }
                }
            );                
            }
            $scope.cancelOrder = function (order) {
//                DtDialog.confirm();
            };
            $scope.sendOrder = function(order) {
                order.backup();
                console.log(order);
                DtDialog.show(
                    $scope,
                    laroute.route('page',{'view':'form-send-order'}),
                    ['Envió de pedido...', 'Envío del pedido {{order.id}}'],
                    undefined, [
                        {
                            label : 'Envíar',
                            cssClass: 'btn-primary',
                            action : function (dialog) {
                                order.send().then(function() {
                                    $scope.dtInstance.reloadData(function() {
                                        order.backup();
                                        dialog.close();
                                    }, !true);
                                });
                            }
                        }, DtDialog.btns.cancel
                    ], {
                        draggable: true,
                        onhide : function () {
                            $timeout(function() {
                                order.rollback();
                            }, 1);
                        }
                    }
                );
            };
            $(document).ready(function() {
                $(".catalogMenu").hide();  
            });
            
            $scope.detalle = function (id, event) {
                event.preventDefault();
                DtDialog.show(
                    $scope,  
                    laroute.route('page',{view : 'form-detail-order'}),                
                    ['Detalle de pedido...', 'Detalle del pedido {{order.id}}'],
                    function () {
                        var $def = $q.defer(); 
                        Order.getById(id,{
                            with: 'user,coupon,items,items.product,items.stock,items.stock.color,items.stock.size,address,address.state,address.country,billing_information,billing_information.state,billing_information.country'
                        }).then(function(order) {
                            $scope.order = order; 
                            var dOrder = order.items();
                            var dUser = order.user();  
                            $q.all([dOrder, dUser]).then(function(res) {
                                console.log(order);
                                $def.resolve();
                            }); 
                        });
                        return $def.promise;
                    }
                );
            }
            dtOptions = function ($options) {
                    $options.withOption('order', [[1, 'desc']]);
            }
            var linkDetails = function (id, text) { 
                return '<a href="#" ng-click="detalle(' + id + ',$event)">' + text + '</a>'
            };
            getColumnBuilder = function () {
                return [
                    DTColumnBuilder.newColumn('id').withTitle("ID").renderWith(function(data){
                        return linkDetails(data,data);
                    }),
                    DTColumnBuilder.newColumn('created_at').withTitle("Fecha de orden").renderWith(function(data, type, full) {
                        return linkDetails(full.id, date(data, DATETIME_FORMAT));
                    }), 
                    DTColumnBuilder.newColumn('total').withTitle("Total").renderWith(function(data, type, full) {
                        return linkDetails(full.id, currency(full.total, "$"));
                    }),
                    DTColumnBuilder.newColumn('user_id').withTitle("Usuario").renderWith(function (data, type, full) {
                       return linkDetails(full.id, full.user.email); 
                    }),
                    DTColumnBuilder.newColumn(null).withTitle('Pago').renderWith(function(data, type, full) {
                        var txt = '';
                        switch(data.status){
                            case Order.STATUS_STAN_BY:
                                txt = '<span style="color:orange">En espera</span>';;
                                break;
                            case Order.STATUS_PAYMED:
                                txt = '<span style="color:green">Pagado</span>';
                                break;
                            case Order.STATUS_CANCEL: 
                                txt = '<span style="color:red">Cancelada</span>';
                                break;
                        }
                        return linkDetails(full.id, txt); 
                    }),
                    DTColumnBuilder.newColumn(null).withTitle("Enviado").renderWith(function (data, type, full) {
                       return linkDetails(full.id, full.sent ? 
                            '<span style="color:green">Si</span>'
                           :'<span style="color:red">No</span>'); 
                    })
//                    DTColumnBuilder.newColumn(null).withTitle("").notSortable().renderWith(function(data, type,full,meta){
//                            return '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>'+
//                            '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'+
//                            '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
//                    })
                ];
            };
            console.log( DTColumnBuilder.newColumn(null).withTitle(''));
            //console.log(Order.getAll());
        }
        //</editor-fold>

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $scope.saveItem = function ($event) {
            console.log("guardado...");
            if($scope.validateForm){
                console.log("validando...");
                if($scope.validateForm() === false) {
                    return;
                }
            }
            if($scope.prepareItem){
                $scope.prepareItem();
            }
            $scope.selectedItem.save().then(function () {
                $scope.selectedItem.backup();
                var $dialog = $($event.target).closest('.modal');
                $dialog.modal('hide')
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
                },
                onhidden: function(dialog){
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
                    message: getRemoveTitle(),
                    title: 'Eliminar',
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
        if(dtOptions) {
            dtOptions( $scope.dtOptions );
        }
        $scope.dtInstance = {};
        $scope.dtColumns = getColumnBuilder();
    });
}();
