setpoint.service('Cart', function($q, $http, localStorageService, CartItem) {
    var ls = localStorageService;
    this.getIdStocks = function () {
        var cart = ls.get('items');
        var ids = [];
        angular.forEach(cart, function(o,i) {
            ids.push(i);
        });
        return ids;
    };
    this.getStocks = function () {
        var defer = $q.defer();
        var stocks = this.getIdStocks();
        var url = laroute.route('stock.getStocks', {
            'stocks' : stocks
        });
        $http.get(url).then(function(response) {
            defer.resolve(response.data);
        });
        return defer.promise;
    };
    var arrItems = [];
    this.getStocks().then(function(items) {
        var cart = ls.get('items');        
        angular.forEach(items, function(item) {
            arrItems.push(new CartItem(item, cart[item.id]));
        });
    });
    this.getItems = function () {
        return arrItems;
    };
    
    this.getSubTotal = function () {
        var subTotal = 0;
        angular.forEach(arrItems, function(item){
            subTotal += item.getSubTotal();
        });
        return subTotal;
    };
    
    this.removeItem = function (item) {
        var index = arrItems.indexOf(item);
        arrItems.splice(index,1);
        return this;
    }
    
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
    this.getTotal = function () {
        return this.getSubTotal();
    }
    this.checkStock = function(){
        
    };
    this.persistItems = function () {
        var persitItems = {};
        angular.forEach(arrItems, function(item) {
            persitItems[item.getStockId()] = item.quantity();
        });
        ls.set('items', persitItems);   
        return this;
    };
    this.addProduct = function(product, quantity, size, color) {
        checkIsSupported();
        var defer = $q.defer();
        product.checkStock(quantity, size, color)
            .then(function(x) {
                var stock_id = x.stock;
                var cart = ls.get('items');                    
                if(!cart) {
                    cart = {};
                }
                cart[stock_id] = parseInt(quantity, 10);
                ls.set('items', cart);                
                defer.resolve(stock_id, quantity);
            }, function(message) {
                BootstrapDialog.alert({
                    title : 'Error',
                    message: message
                });
            });
        return defer.promise;
    };
});