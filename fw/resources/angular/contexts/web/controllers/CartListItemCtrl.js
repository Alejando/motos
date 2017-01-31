setpoint.controller('CartListItemCtrl', ['$scope', 'Cart',
    function($scope, Cart){
        $scope.items = Cart.getItems();
        $scope.cart = Cart;
        $scope.couponCode='';
        Cart.onInvalidateCoupon = function () {
            BootstrapDialog.alert({
                title : 'Notifiación',
                message : 'Tu cupón ha sido retirado ya que no cuentas con el monto minimo para aplicarlo'
            })
        };
        $scope.applyCoupon = function () {
            if(!$scope.couponCode) {
                $scope.errorCoupon = true;
                $scope.errorCouponMessage = "Escribe tu cupón";
                return;
            }
            Cart.applyCoupon($scope.couponCode).then(function(){
                $scope.errorCoupon = false;
            }, function(error) {
                $scope.errorCoupon = true;
                $scope.errorCouponMessage = error; 
            });
        }
        
        $scope.couponChange = function () {
             $scope.errorCoupon = false;
        }
        $scope.setItemQuantity = function (item, quantity) {
             item.quantity(quantity);
             cart.persistItems()
        }
        $scope.removeCoupon = function (){
            BootstrapDialog.confirm({
                title : 'Confirmación',
                message : '¿Desea retirar el cupón?',
                callback : function(ok){
                    if(ok) {
                        $scope.$apply(function(){
                            Cart.removeCoupon();
                        });
                    }
                }
            });
        }
        $scope.removeItem = function (item) { 
            BootstrapDialog.confirm({ 
                title: 'Confirmación',
                message: '¿Deseas de eliminar el producto de tu carrito?', 
                callback : function (ok) {
                    if(ok){
                        $scope.$apply(function() {
                            Cart.removeItem(item);
                        });
                    }
                }
            });
        }
        
        $('.cart').fadeIn("slow");
}]);

