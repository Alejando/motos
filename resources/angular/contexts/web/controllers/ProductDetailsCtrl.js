!function() {
    setpoint.controller("ProdcutDetailsCtrl", function($scope, Product, Color, $q) {
        var loadProduct = Product.getById(window.product);
        $scope.changeColor = function(id_color) {
            Color.getById(id_color).then(function(color) {
                console.log(color);
            });
        };
        $scope.ok = function(img) {
            $scope.selectedImg = img;
            $scope.product.getImgs().then(function(img){
                $scope.selectedImgs = img;
            });   
        }
       
        
        loadProduct.then(function(product) {
            $scope.product = product;
            console.log($scope.product);
            var loadColors = $scope.product.colors();
            var loadSizes = $scope.product.sizes();
            var loadImgs = $scope.product.getImgs();            
            $q.all([loadColors, loadSizes, loadImgs]).then(function(data){
                $scope.colors = data[0];
                $scope.sizes = data[1];
                $scope.imgs = data[2];
                $scope.selectedImgs = $scope.imgs;
            });
        })
        
    });
}();