setpoint.service('Cart', function($q, $http, localStorageService, CartItem, Coupon) {
    var ls = localStorageService;
    this.appliedCode = false;
    this.discount = false;
    var arrItems = [];
    //<editor-fold defaultstate="collapsed" desc="this.getIdStock">
    this.getIdStocks = function () {
        var cart = ls.get('items');
        var ids = [];
        angular.forEach(cart, function(o,i) {
            ids.push(i);
        });
        return ids;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.getStocks">
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
    //</editor-fold>

    this.getStocks().then(function(items) {
        var cart = ls.get('items');        
        angular.forEach(items, function(item) {
            arrItems.push(new CartItem(item, cart[item.id]));
        });
    });

    //<editor-fold defaultstate="collapsed" desc="this.getItems">
    this.getItems = function () {
        return arrItems;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.getSubTotal">
    this.getSubTotal = function () {
        var subTotal = 0;
        angular.forEach(arrItems, function(item){
            subTotal += item.getSubTotal();
        });
        return subTotal;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.removeItem">
    this.removeItem = function (item) {
        var index = arrItems.indexOf(item);
        arrItems.splice(index,1);
        return this;
    }
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.checkIsSupported">
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
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.getTotal">
    this.getTotal = function () {
        var subtotal = this.getSubTotal();
        var discount = this.getDiscount();
        return subtotal - discount;
    }
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.checkStock">
    this.checkStock = function(){
        
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.presistItems">
    this.persistItems = function () {
        var persitItems = {};
        angular.forEach(arrItems, function(item) {
            persitItems[item.getStockId()] = item.quantity();
        });
        ls.set('items', persitItems);   
        return this;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.checkCoupon()">
    this.checkCoupon = function (codeCoupon){
        
    }
    //</editor-fold>
    this.getDiscount = function () {
        return this.discount;
    }
    this.setDiscountByMount = function (coupon) {
        this.discount = parseFloat(coupon.discount, 10);
    }
    //<editor-fold defaultstate="collapsed" desc="this.applyCoupon">
    this.applyCoupon = function (couponCode) {
        var defer = $q.defer();
        var self = this;
        Coupon.getByCode(couponCode).then(function(coupon) {
            console.log(parseFloat(coupon.amount_min,10),self.getSubTotal());
            if(parseFloat(coupon.amount_min,10) > self.getSubTotal()) {
                defer.reject("El Carrito no cuenta con el monto minimo ($ " + coupon.amount_min + ")");
            } else {
                switch(coupon.type){
                    case Coupon.types.PERSENT_BY_AMMOUNT: 
                        console.log("Porcentaje por monto");
                    break;
                    case Coupon.types.DISCOUNT_BY_AMMOUNT:
                        self.setDiscountByMount(coupon);
                    break;
                    case Coupon.types.FREE_PRODUCT_BY_AMMOUNT:
                        console.log("producto gratis");
                    break;
                }
            }
        
        },function(e){
            defer.reject(e.message);
        });
        return defer.promise;
        if( (coupon = this.checkCoupon()) ) {
            console.log(coupon);
            return true;
        }
        return false;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.addProduct">
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
    //</editor-fold>
    
});