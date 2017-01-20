setpoint.service('Cart', function($q, $http, localStorageService, CartItem, Coupon, $timeout, $filter, BillingInformation, IVA, Address) {
    var ls = localStorageService;
    this.appliedCode = false;
    this.discount = false;
    var arrItems = [];
    var _coupon = null;
    var couponStock = null;
    var cart = this;
    this.onInvalidateCoupon = function () {
        console.log("Quitar Cupon");
    };
    this.coupon_id = ls.get('cart.coupon');
    this.addess_id = ls.get('cart.address');
    var sp = ls.get('cart.shipping');
    this.shippingPrice = sp ? sp : 0;
    this.PSP_PAYPAL = 1;
    this.PSP_TC_CONEKTA = 2; 
    this.PSP_OXXO_CONEKTA = 3;
    var currency = $filter('currency');
    var self = this;
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
    this.shipingRourles = null;
    if(this.addess_id) {
        Address.getShippingRules(this.addess_id).then(function(config) {
            self.shipingRourles = config;
        });
    }
    this.getStocks().then(function(items) {
        var cart = ls.get('items');        
        angular.forEach(items, function(item) {
            item['cart'] = self;
            var cartItem = new CartItem(item, cart[item.id]);
            arrItems.push(cartItem);
            self.setCouponById(ls.get('cart.coupon'));
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
//        if(this.shippingPrice){
//            Address.getShippingPrice(this.addess_id, subTotal).then(function(price) {
//                console.log("-----", self);
//               self.shippingPrice = price;
//            });
//        };
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
        var shipping = this.getShippingAmount();
        return (subtotal - discount + shipping);
    }
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.checkStock">
    this.checkStock = function(){
        
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="this.presistItems">
    this.persistItems = function () {
        ls.set('items', this.getPersistItems());   
        return this;
    };
    //</editor-fold>
    this.getPersistItems = function () {
        var persitItems = {};
        angular.forEach(arrItems, function(item) {
            persitItems[item.getStockId()] = item.quantity();
        });
        return persitItems;
    };
    var cart = this;
    var cleanCoupon = function() {
        cart.discount = 0;
        cart.percentDiscount = 0;
        if(_coupon.type == Coupon.types.FREE_PRODUCT_BY_AMOUNT) {
            var item = cart.getItemByStock(couponStock);
            if(item) {
                var q = item.quantity();
                if(q>1){
                    item.quantity(q-1);
                } else {
                   cart.removeItem(item);
                }
            }
        }
        _coupon = null;
        ls.remove('cart.coupon');
    };
//<editor-fold defaultstate="collapsed" desc="this.checkCoupon()">
    this.checkCoupon = function () {
        if(_coupon){
            if(_coupon.amount_min) {
                var priceProduct = 0;
                if(couponStock){
                    priceProduct = parseFloat(couponStock.price);
                }
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
            with : 'product,color,size'
        }).then(function(stock) {
            stock.product().then(function(product) {
                var item = self.getItemByStock(stock);
                if(item === null) { //No esta agregado el item
                    self.addStock(stock,1); 
                }
                console.log(stock);
                self.setDiscount(stock.getPrice());
                couponStock = stock;
            });
        });
    }
    var applyCoupon = function (coupon, defer) {
        if(parseFloat(coupon.amount_min,10) > self.getSubTotal()) {
            defer.reject("El Carrito no cuenta con el monto minimo (" + currency(coupon.amount_min) + ")");
        } else {
            try {
                switch(coupon.type) { 
                    case Coupon.types.PERSENT_BY_AMOUNT:
                        self.setPersentDiscountByMount(coupon);
                    break;
                    case Coupon.types.DISCOUNT_BY_AMOUNT:
                        self.setDiscountByMount(coupon);
                    break;
                    case Coupon.types.FREE_PRODUCT_BY_AMOUNT:
                        self.setProductByAmount(coupon);
                    break;
                }
                _coupon = coupon;
                ls.set('cart.coupon', coupon.id);
                defer.resolve();
            } catch(e) {
                defer.reject(e.message);
            }
        }
    };
    
    this.setCouponById = function (id_coupon) {
        var defer = $q.defer();
        if(id_coupon){
            Coupon.getById(id_coupon).then(function(coupon) {
               applyCoupon(coupon, defer);
            }, function(e) {
                defer.reject(e.message);
            });
        } else {
            $timeout(function() {
                defer.reject();
            }, 5);
        }
        return defer.promise;
    }
    //<editor-fold defaultstate="collapsed" desc="this.applyCoupon">
    this.applyCoupon = function (couponCode) {
        var defer = $q.defer();
        Coupon.getByCode(couponCode).then(function(coupon) {
            applyCoupon(coupon, defer);
        },function(e){
            defer.reject(e.message);
        });
        return defer.promise;
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
    this.getItemByStock = function(stock) {
        var item = null;
        for(var i = 0; (item = arrItems[i++]);) {
            if(item.stock_id == stock.id) {
                //item.quantity(item.quantity()+1);
                return item;
            }
        }
        return null;
    }
    //</editor-fold>
    this.addStock = function (stock, quantity) {
        var item  = this.getItemByStock(stock);        
        if(item) {
            item.quantity(item.quantity() + 1);
                this.persistItems(); 
            return;
        }
        try { 
            var cartItem = new CartItem({
                id : stock.id,
                price: stock.price,
                color_id: stock.color_id,
                color : stock.relations.color,
                product : stock.relations.product,
                size : stock.size_id,
                cart : this
            },quantity);
         }catch(e) {
             console.log("----Error .> %o ", e);
         }
        arrItems.push(cartItem);
        this.persistItems();
    }
    this.removeCoupon = function () {
        cleanCoupon();
    }
    this.setShippingAddress = function (address) {
        this.shippingAddress = address;  
        if(address && address.id){
            this.addess_id = address.id;
        }
    };
    this.getShippingAddress = function () {
        return this.shippingAddress;
    };
    this.setBillingInformation = function (billingInformation) {
        this.billingInformation = billingInformation;
    };
    this.removeBillingInformation = function () {
        this.billingInformation = undefined;
        ls.remove('cart.billingInformation');
    }
    this.getBillingInformation = function () {
        return this.billingInformation;
    };  
    this.requestBillig = function () {
        return !!this.getBillingInformation();
    };
    this.getApportion = function (amount) {
        if(this.requestBillig()) {
            return amount / (1 + (IVA / 100));
        }
        return amount;
    };
    this.loadBillingInformation = function () {
        var def = $q.defer();
        BillingInformation.getById(this.getBillingInformation()).then(function(inst) {
            def.resolve(inst);
        }, function() {
            def.reject(int);
        });
        return def.promise;
    };
    this.persitInfo = function () {
        ls.set('cart.address', this.shippingAddress.id);  
        if( this.billingInformation){
            ls.set('cart.billingInformation', this.billingInformation.id);  
        }
    } 
     
    this.setShippingAddress(ls.get('cart.address'));
    this.setBillingInformation(ls.get('cart.billingInformation'));
    
    this.getShippingAmount = function () {
        if(this.shipingRourles) {
            var subtotal = this.getSubTotal();
            var rules =this.shipingRourles;
            if(subtotal >= rules.amountForFree){
                return 0;
            }
            return this.shipingRourles.price;
            }
        return 0;
    }
    
    
    this.getTax = function () {
        if('billingInformation', this.billingInformation) {
            return ((this.getTotal()-this.getShippingAmount())/100)*IVA;
        }
        return 0;
    }
    
    this.setPaymentServiceProvide = function (pspCodeName) {
        this.psp = pspCodeName;
    };
    this.getCouponId = function () {
        return this.coupon_id;
    };
    this.prepareData = function () {
        var items = this.getPersistItems();
        
        var data = {
            billing_info : this.getBillingInformation(),
            shipping_address : this.getShippingAddress(),
            coupon : this.getCouponId(),
            psp: this.psp,
            items : items
        };
        if(this.psp === this.PSP_TC_CONEKTA) {
           data.tel = conekta.form.find(".tel").val();
        }
        return data;
    };
    var conekta = {
        conektaSuccessResponseHandler: function (def, token, context) {
            var data = cart.prepareData();
            data['conektaToken'] = token.id;
            cart.sendCheckout(data, def); 
        },
        conektaErrorResponseHandler : function (defer, fail, context) {
            defer.reject({
                message : fail.message_to_purchaser,
                pspInfo : fail
            });
        }
    };
    
    this.setConektaCardForm = function (form) { 
        conekta.form = form;
    };
    
    var createConektaToken = function (defer) { 
        Conekta.token.create( conekta.form, 
            function (token) {  
                conekta.conektaSuccessResponseHandler(defer, token, this);
            }, 
            function (fail) { 
                conekta.conektaErrorResponseHandler(defer, fail, this);
            }
        );
    };
    this.sendCheckout = function (data,defer) {
        var url = laroute.route("cart.checkout");
        $http.post(url, data).then(function (request) {
            if(request.data.error){
                defer.reject(request.data);
                return;
            }
            defer.resolve(request.data, request);
        }, function (fail) {
            defer.reject(fail);
        });
    }
    this.checkout = function () {
        var defer = $q.defer();
        if(this.psp === this.PSP_TC_CONEKTA) {
           createConektaToken(defer);
        } else { 
            this.sendCheckout(
                this.prepareData(),
                defer
            );            
        }
        return defer.promise;  
    };
});