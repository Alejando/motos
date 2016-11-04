setpoint.factory('Coupon', ['ModelBase', '$q', '$http', function(ModelBase, $q, $http) {
    var Coupon = function () {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Coupon, {
        alias : 'coupon',
        setter : {
            start_date : ModelBase.setDate,
            expire_date : ModelBase.setDate
        },
        attributes : [
            'id',
            'start_date',
            'expire_date',
            'amount_min',
            'percent',
            'discount'
        ],
        preparers : {
            start_date :ModelBase.prepareDateTime,
            expire_date: ModelBase.prepareDateTime
        },
        relations : []
    }, {
        
    });
    return Coupon;
}]);