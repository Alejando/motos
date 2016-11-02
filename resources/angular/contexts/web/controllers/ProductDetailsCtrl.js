!function() {
    setpoint.controller("ProductDetailsCtrl", function($scope, Product, Color, $q, Cart) {
        $scope.cart = Cart;
        console.log('window.product', window.product);
        var loadProduct = Product.getById(window.product);
        $scope.selectImg = function(img) {
            $scope.selectedImg = img;
        }
        $scope.selectedColor = null;
        $scope.selectedSize = null;
        
        $scope.addProduct = function ($event) {
            $event.preventDefault();
            console.log("selected Size => ",$scope.selectedSize);
            if($scope.sizes.length && ($scope.selectedSize===null || $scope.selectedSize==="") ) {
                BootstrapDialog.alert('Selecciona una talla/tamaño');
                return;
            }
            
            Cart.addProduct(
                $scope.product,
                parseInt($('#cantidad').val(), 10),
                parseInt($scope.selectedSize, 10),
                parseInt($scope.selectedColor, 10)
            ).then(function() {
                BootstrapDialog.show({
                    'message' : 'Tu producto se ha agregado al carrito, ir a carrito, continuar aquí, ir a la categoria',
                    'title' : 'Confirmación',
                    'buttons': [
                        {
                            label: 'Ir a carrito',
                            action : function () {
                                alert("Al Carrito");
                            }
                        },{
                            label: 'Continuar Aquí',
                            action: function() {
                                alert("Continuar Aquí");
                            }
                        }, {
                            label: 'Ver mas productos',
                            action: function (){
                                alert("Ir a la cateria");
                            }
                        }
                    ]
                });
            });
        };
        
        $scope.selectColor = function (id_color,stopRecursive) {
            console.log(id_color);
            if(stopRecursive === undefined) {
                $scope.selectedColor = id_color;
                console.log($scope.selectedColor);
            }
            Color.getById(id_color).then(function(color) {
                var selectedImgs = [];
                angular.forEach($scope.imgs, function(img) {
                    $scope.selectedImgs = [];
                    if(new RegExp('^' + color.pref + ' - ').test(img)) {
                       selectedImgs.push(img);
                    }
                });
                $scope.selectedImgs = selectedImgs;
                if(selectedImgs.length) {
                    $scope.selectImg(selectedImgs[0]);
                }else {
                    if(stopRecursive === undefined) {
                        $scope.selectColor($scope.defaultColor.id, true);
                    }
                    
                }
            });
        };  
        $scope.setGallery = function () {
            console.log($scope.imgs);
            if($scope.imgs.length) {
                $scope.selectedImg = $scope.imgs[0];
                if($scope.imgs.length>1) {
                    $scope.selectedImgs  = $scope.imgs;
                }
            }
        }
        loadProduct.then(function(product) {
            $scope.product = product;
            var loadColors = $scope.product.colors();
            var loadSizes = $scope.product.sizes();
            var loadImgs = $scope.product.getImgs(); 
            $q.all([loadColors, loadSizes, loadImgs]).then(function(data) {
      
                var COLORS = 0;
                var SIZES = 1;
                var IMGS = 2;
                var DEFAULT_COLOR = 3;
                
                $scope.colors = data[COLORS];
                $scope.sizes = data[SIZES];
                $scope.imgs = data[IMGS];
                $scope.defaultColor = data[DEFAULT_COLOR];

                if( data[COLORS].length ) {
                    $scope.product.defaultColor().then(function(defaultColorId) {
                        var defaultColorId = defaultColorId;
                        $scope.selectColor(defaultColorId.id);
                    }, function(){
                    });
                } else {
                    $scope.setGallery();
                }
            },function(){
            });
        });
    });
}();