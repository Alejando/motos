setpoint.controller('CartListItemCtrl', ['$scope', 'Cart',
    function($scope, Cart){
        $scope.items = Cart.getItems();
        console.log($scope.items); 
        $scope.cart = Cart;
        $scope.couponCode='';
        $scope.applyCoupon = function () {
            
            if(!$scope.couponCode) {
                $scope.errorCoupon = true;
                $scope.errorCouponMessage = "Escribe tu cupón";
                return;
            }
            Cart.applyCoupon($scope.couponCode).then(function(){
                
            }, function(error) {
                $scope.errorCoupon = true;
                $scope.errorCouponMessage = error; 
            });
        }
        $scope.couponChange = function () {
             $scope.errorCoupon = false;
        }
        $scope.removeItem = function (item) {
            BootstrapDialog.confirm({
                title: 'Confirmación',
                message: '¡Deseas de eliminar el producto de tu carrito?',
                callback : function (ok) {
                    if(ok){
                        $scope.$apply(function() {
                            Cart.removeItem(item);
                        });
                    }
                }
            });
        }
        
}]);

