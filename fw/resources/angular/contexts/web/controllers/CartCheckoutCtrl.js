setpoint.controller('CartCheckoutCtrl', [
    '$scope', 'Cart',
    function($scope, Cart) {
        $scope.cart = Cart;
        $scope.items = Cart.getItems();
        $scope.provider = null;
        $scope.setProvider = function (provider) {
            $scope.pspError = false;
            $scope.providerSelected = provider;
            Cart.setPaymentServiceProvide(provider);
        };
        $scope.phpError = false;
        Cart.setConektaCardForm($('#formpago')); 
        $scope.checkout = function (evt) {
            $scope.pspError = false;
            if(!$scope.providerSelected) {
                $scope.pspError = "Selecciona una forma de pago";
                return;
            }
            evt.preventDefault();
            Cart.checkout().then(function (data) {
                window.open(data.url, '_self'); 
            }, function (fail) {
                
                $scope.pspError = fail.message;
                console.log($scope.pspError);
            });
        };
    }
]);