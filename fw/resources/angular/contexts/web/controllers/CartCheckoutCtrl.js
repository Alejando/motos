setpoint.controller('CartCheckoutCtrl', [
    '$scope', 'Cart', 'dtErrorHelpers',
    function($scope, Cart, dtErrorHelpers) {
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
        $scope.sending = false;
        $scope.checkout = function (evt) {
            $scope.sending = true;
            $scope.pspError = false;
            if(!$scope.providerSelected) {
                $scope.sending = false;
                $scope.pspError = "Selecciona una forma de pago";
                return;
            }
            evt.preventDefault();
            var promCheckout = Cart.checkout();
            dtErrorHelpers.goToElementOnReject(promCheckout,'.pspError');
            promCheckout.then(function (data) {
                window.open(data.url, '_self'); 
            }, function (fail) {
                $scope.sending = false;
                $scope.pspError = fail.message;
            });
        };
    }
]);