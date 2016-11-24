setpoint.service('Cart', function($q, $http, localStorageService, CartItem, Coupon) {
    var ls = localStorageService;
    this.appliedCode = false;
    this.discount = false;
    var arrItems = [];
    var _coupon = null;
    var couponStock = null;
    this.onInvalidateCoupon = function (){
        console.log("Quitar Cupon");
    };
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
        arrItems.splice(index, 1);
        this.persistItems();
        if(couponStock && couponStock.id === item.stock_id) {
            cleanCoupon();
        }
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
    var cart = this;
    var cleanCoupon = function() {
        cart.discount = 0;
        cart.percentDiscount = 0;
        if(_coupon.type == Coupon.types.FREE_PRODUCT_BY_AMMOUNT){
            var item = cart.getItemByStock(couponStock);
            if(item){
                var q = item.quantity();
                if(q>1){
                    item.quantity(q-1);
                } else {
                   cart.removeItem(item);
                }
            }
        }
         _coupon = null;
    }
//<editor-fold defaultstate="collapsed" desc="this.checkCoupon()">
    this.checkCoupon = function (){
        if(_coupon){
            if(_coupon.amount_min) {
                var priceProduct = 0;
                if(couponStock){
                    priceProduct = parseFloat(couponStock.price);
                }
//                var min = _coupon.type != Coupon.types.FREE_PRODUCT_BY_AMMOUNT ? _coupon.amount_min : _coupon.amount_min + couponStock.price;
                console.log(parseFloat(_coupon.amount_min) + parseFloat(priceProduct));
                if( ( parseFloat(_coupon.amount_min) + parseFloat(priceProduct) ) > this.getSubTotal()){
                    cleanCoupon();
                    this.onInvalidateCoupon();
                }
            }
        }
        return true;
    }
    //</editor-fold>
    this.getDiscount = function () {
        this.checkCoupon();
        if(this.percentDiscount) {
            return this.getSubTotal() * (this.percentDiscount/100) ;
        }
        return this.discount;
    };
    this.setDiscount = function (discount) {
        this.discount = parseFloat(discount, 10);
        return this;
    }
    this.setDiscountByMount = function (coupon) {
        this.discount = parseFloat(coupon.discount, 10);
    }
    this.percentDiscount = 0;
    this.setPersentDiscountByMount = function (coupon) {
        this.percentDiscount = coupon.percent;
    }
    this.setProductByAmount = function (coupon) {   
        var self = this;
        if(coupon.formAnyStock()) {
//            coupon.getAnyStock().then(function(stock){//Buscar un stock con existencias
//                console.log(stock);
//            });
        } else {//Un stock definido
            
        }
        coupon.stock({
            with : 'product'
        }).then(function(stock){
            stock.product().then(function(product) {
                var item = self.getItemByStock(stock);
                if(!item){
                    self.addStock(stock,1);
                }
                self.setDiscount(stock.price);
                couponStock = stock;
            });
        });
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
                try{
                    switch(coupon.type){
                        case Coupon.types.PERSENT_BY_AMMOUNT:
                            self.setPersentDiscountByMount(coupon);
                        break;
                        case Coupon.types.DISCOUNT_BY_AMMOUNT:
                            self.setDiscountByMount(coupon);
                        break;
                        case Coupon.types.FREE_PRODUCT_BY_AMMOUNT:
                            self.setProductByAmount(coupon);
                        break;
                    }
                    _coupon = coupon
                    defer.resolve();
                }catch(e){
                    defer.reject(e.message);
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
    this.getItemByStock = function(stock){
        
        var item;
        for(var i = 0; (item = arrItems[i++]);){
            console.log(stock.id);
            if(item.stock_id == stock.id){
                //item.quantity(item.quantity()+1);
                return item;
            }
        }
    }
    //</editor-fold>
    this.addStock = function (stock, quantity){
        var item  = this.getItemByStock(stock);        
        if(item){
            console.log("Ya esta en el carrito", item);
            item.quantity(item.quantity()+1);
                this.persistItems();
            return;
        }
        console.log("El item aun no esta en el carrito");
        arrItems.push(new CartItem({
            id : stock.id,
            price: stock.price, 
            color_id: stock.color_id,
            product : stock.relations.product,
            size : stock.size_id 
        },quantity));
        this.persistItems();
    }
    this.removeCoupon = function () {
        cleanCoupon();
    }
    
});