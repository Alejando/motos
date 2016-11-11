setpoint.factory('Coupon', ['ModelBase', '$q', '$http', function(ModelBase, $q, $http, Product, Stock) {
    var Coupon = function () {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Coupon, {
        types:{
            PERSENT_BY_AMMOUNT : 1,
            DISCOUNT_BY_AMMOUNT : 2,
            FREE_PRODUCT_BY_AMMOUNT : 3
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
        ]
    }, {
        getValidateUniqueCodeURL : function () {
            return "lalala";
        }
    });
    return Coupon;
}]);