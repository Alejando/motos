setpoint.factory('Order', function (ModelBase, $q, $http, Item, Coupon, Address, User, BillingInformation) {    
    var Order = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Order , {   
        alias: 'order',
        PSP_PAYPAL : 1,
        PSP_TC_CONEKTA : 2,
        setters : {
        },
        attributes: [
            'id',
            'subtotal',
            'tax',
            'shipping',
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
            'paid',
            'sent',
            'guia',
            'urlguia',
            'bill_number'
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