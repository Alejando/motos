setpoint.controller('CartListItemCtrl', ['$scope', 'Cart',
    function($scope, Cart){
        $scope.items = Cart.getItems();
        $scope.cart = Cart;
        
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

