setpoint.service('Cart', function($q, $http, localStorageService) {
    var checkIsSupported = function () {
        if(!localStorageService.isSupported) {
            BootstrapDialog.alert({
//                closable: false,
                title : 'Error',
                message: 'Lo setimos tu explorador no es compatible, por favor actualiza tu explorador'
            });
            throw new Error("Explorador no compatible con storage service");
        }
    }
    this.checkStock = function(){
        
    };
    this.addProduct = function(product, quantity, size, color) {
        checkIsSupported();
        product.checkStock(quantity, size, color)
            .then(function(x) {
                var stock_id = x.stock;
                var ls = localStorageService;
                var cart = ls.get('items');                    
                if(!cart) {
                    cart = {};
                }
                cart[stock_id] = parseInt(quantity, 10);
                ls.set('items', cart);                
            }, function(message) {
                BootstrapDialog.alert({
                title : 'Error',
                message: message
            });
            });
    };
});