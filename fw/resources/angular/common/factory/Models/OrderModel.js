setpoint.factory('Order', function (ModelBase, $q, $http, Item, Coupon, Address, User) {    
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
            'bills_info_id',
            'billing_information_id',
            'psp',
            'paid',
            'sent',
            'guia',
            'urlguia'
        ],
        relations : [
            ['items', Item, 'hasMany'],
            ['coupon', Coupon, 'belongsTo'],
            ['address', Address, 'belongsTo'],
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
        send : function (guia, urlguia) {
            console.log(urlguia);
            var  def = $q.defer();
            var url = laroute.route('order.send', {
                order : this.id
            });
            $http.put(url,{
                url  : urlguia,
                guia : guia
            }).then(function(result){
                if(result.data.success){
                    self.sent = true;
                    self.guia = guia;
                    self.url = url;
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