setpoint.factory('Order', function (ModelBase, $q, $http, Item, Coupon, Address, User) {    
    var Order = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Order , {   
        alias: 'order',
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
            'psp'
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
            $http.get(url).then(function(result){
                console.log(result.data);
                def.resolve(result.data);
            });
            return def.promise;
            //return "items*";
        }
    }, {
    });
    
    User.addRelation('orders', Order, 'hasMany');
    return Order;
});