!function() {
    setpoint.controller("ProdcutDetailsCtrl", function($scope, Product, Color, $q) {
        console.log('window.product', window.product);
        var loadProduct = Product.getById(window.product);
        $scope.selectImg = function(img) {
            $scope.selectedImg = img;
        }
        $scope.selectedColor = false;
        $scope.selectColor = function (id_color,stopRecursive) {
            if(stopRecursive === undefined){
                $scope.selectedColor = id_color;
            }
            Color.getById(id_color).then(function(color) {
                var selectedImgs = [];
                angular.forEach($scope.imgs, function(img) {
                    $scope.selectedImgs = [];
                    if(new RegExp('^' + color.pref + ' - ').test(img)){
                       selectedImgs.push(img);
                    }
                });
                $scope.selectedImgs = selectedImgs;
                if(selectedImgs.length){
                    $scope.selectImg(selectedImgs[0]);
                }else {
                    if(stopRecursive===undefined) {
                        $scope.selectColor($scope.defaultColor.id, true);
                    }
                    
                }
            });
        };  
        loadProduct.then(function(product) {
            $scope.product = product;
            var loadColors = $scope.product.colors();
            var loadSizes = $scope.product.sizes();
            var loadImgs = $scope.product.getImgs(); 
            var loadDefaultColor = $scope.product.defaultColor();
            $q.all([loadColors, loadSizes, loadImgs, loadDefaultColor]).then(function(data){
                $scope.colors = data[0];
                $scope.sizes = data[1];
                $scope.imgs = data[2];
                $scope.defaultColor = data[3];                 
                $scope.selectColor(data[0][0].id);
            });
        });
    });
}();