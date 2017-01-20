    setpoint.factory('Order', function (ModelBase, $q, $http, Item, Coupon, Address, User, BillingInformation) {    
    var Order = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Order , {   
        alias: 'order',
        PSP_PAYPAL : 1,
        PSP_TC_CONEKTA : 2,
        STATUS_STAN_BY : 0,
        STATUS_PAYMED : 1,
        STATUS_CANCEL : 3,
        setters : {
            created_at : ModelBase.setDate,
        },
        attributes: [
            'id',
            'subtotal',
            'tax',
            'shipping',
            'status',
            'total',
            'user_id',
            'coupon_id', 
            'created_at',
            'updated_at',
            'status',
            'tracking_code',
            'estimated_date',
            'billing_information_id',
            'psp',
            'sent',
            'guia',
            'urlguia',
            'bill_number',
            'discount'
        ],
        relations : [
            ['items', Item, 'hasMany'],
            ['coupon', Coupon, 'belongsTo'],
            ['address', Address, 'belongsTo'],
            ['billing_information', BillingInformation, 'belongsTo'],
            ['user', User, 'belongsTo']
        ],
        
        getItems: function(order_id){
            var def = $q.defer();
            var url = laroute.route('order.getDetails', {'order_id': order_id});
            $http.get(url).then(function(result) {                
                def.resolve(result.data); 
            });
            return def.promise;
        }
    }, {
        paid : function () {
            return this.status == Order.STATUS_PAYMED;
        }, 
        cancel : function () {
            var self = this; 
            var def = $q.defer();
            var url = laroute.route('order.cancel', {
                'order' : self.id 
            }); 
            $http.put(url, {}).then(
                function(result) {   
                    if(result.data.status) {
                        self.status = result.data.status;
                    }
                    def.resolve(result.data);
                }, function () {
                    def.reject();
                }
            );
            return def.promise;
        },
        isCanceled : function () {
            return this.status == Order.STATUS_CANCEL; 
        },
        isCancelable : function () {
           if(!this.paid()) {
               if(!this.isCanceled()) {
                    return true;
               }
           }
           return false;
        },
        setBillNumber : function (bill_number) {
            var self = this;
            var def = $q.defer(); 
            var url = laroute.route('order.set-bill-number', {
                order : this.id
            });
            $http.put(url, {
                'bill_number' : bill_number
            }).then(function(result){
                if(result.data.success) {
                    self.bill_number = bill_number;
                };
                def.resolve(result.data);
            });
            return def.promise; 
        },
        send : function (guia, urlguia) {
            var self = this;
            var def = $q.defer();
            var url = laroute.route('order.send', {
                order : this.id
            });
            $http.put(url, {
                url  : self.urlguia,
                guia : self.guia
            }).then(function(result) {
                if(result.data.success) {
                    self.sent = true;
                }
                def.resolve(result.data);
            });
            return def.promise;
        },
        getNamePSP : function () {
            switch(this.psp){
                case 1: return "PayPal";
                case 2: return "TC Conekta"
            }
        }
    });
    
    User.addRelation('orders', Order, 'hasMany');
    return Order;
});