setpoint.controller('CartCheckoutCtrl', [
    '$scope', 'Cart',
    function($scope, Cart) {
        $scope.cart = Cart;
        $scope.items = Cart.getItems();
        $scope.provider = null;
        $scope.setProvider = function (provider) {
            $scope.providerSelected = provider;
            Cart.setPaymentServiceProvide(provider);
        };
        $scope.checkout = function (evt) {
            evt.preventDefault();
            Cart.checkout().then(function (url) {
                window.open(url, 'self');
            }, function (fail) {
                console.log(fail);
            });
        };
    }
]);