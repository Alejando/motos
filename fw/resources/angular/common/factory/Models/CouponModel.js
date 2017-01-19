setpoint.factory('Coupon', ['ModelBase', '$q', '$http', 'Product', 'Stock', function(ModelBase, $q, $http, Product, Stock) {
    var Coupon = function () {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Coupon, {
        types:{
            PERSENT_BY_AMOUNT : 1, 
            DISCOUNT_BY_AMOUNT : 2,
            FREE_PRODUCT_BY_AMOUNT : 3
        },
        alias : 'coupon', 
        setter : {
            start_date : ModelBase.setDate,
            expire_date : ModelBase.setDate
        },
        attributes : [
            'id',
            'code',
            'start_date',
            'expire_date',
            'amount_min',
            'percent',
            'discount',
            'uses_limit', 
            'type'
        ],
        preparers : {
            start_date :ModelBase.prepareDateTime,
            expire_date: ModelBase.prepareDateTime
        },
        relations : [
            ['product', Product, 'belongsTo'],
            ['stock', Stock, 'belongsTo']
        ],
        getByCode : function (code) {
            var defer = $q.defer();
            var url = laroute.route('coupon.getValdateByCode', {
                'code': code
            });
            $http.get(url).then(function(r) {
                if(r.data.error){
                    defer.reject(r.data);
                    return;
                }
                defer.resolve(Coupon.build(r.data));
            }, function() {
                
            });
            return defer.promise;
        }
    }, {
        formAnyStock : function () {
           return !this.stock_id;
        },
        getValidateUniqueCodeURL : function () {
            return "lalala";
        }
    });
    return Coupon;
}]);